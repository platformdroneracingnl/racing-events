<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use PragmaRX\Google2FAQRCode\Google2FA;
use App\Models\Country;
use App\Models\Organization;
use App\Models\Registration;
use App\Models\User;
use Carbon\Carbon;
use App;
use Auth;
use Image;
use File;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the profile.
     *
     * @return \Illuminate\View\View
     */
    public function show() {
        $user = Auth::user();
        $lang = App::getLocale();

        // Get country code from user
        $countryCode = Country::all()->where('id', $user->country)->first();
        // Get organization related to user
        $organization = Organization::with('user')->find($user->organization);
        // Calculate age of user
        $user_age = Carbon::parse($user->date_of_birth)->diff(Carbon::now())->format('%y');
        // User registrations
        $registrations = Registration::where('user_id', $user->id)->get();

        /**
         * Show 2FA Setting form
         */
        $google2fa_url = "";
        $secret_key = "";

        if ($user->loginSecurity()->exists()) {
            $google2fa = new Google2FA();
            $google2fa_url = $google2fa->getQRCodeInline(
                'Platform Drone Racing NL',
                $user->email,
                $user->loginSecurity->google2fa_secret
            );
            $secret_key = $user->loginSecurity->google2fa_secret;
        }

        $data = array(
            'user' => $user,
            'secret' => $secret_key,
            'google2fa_url' => $google2fa_url
        );

        // Get all countries for selectbox
        $countries = Country::all();
        return view('backend.profile.show', compact('lang','data'))
            ->with('countries', $countries)
            ->with('countryCode', $countryCode)
            ->with('organization', $organization)
            ->with('age', $user_age)
            ->with('registrations', $registrations);
    }

    /**
     * Update the profile
     *
     * @param  \App\Http\Requests\ProfileRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileRequest $request) {
        // Check if request contains new image otherwise skip it
        if($request->has('image')) {
            // Remove old image if exist
            $filename = $request->input('oldImage');
            if(File::exists( public_path('storage/images/profiles/' . $filename))) {
                File::delete( public_path('storage/images/profiles/' . $filename));
            }

            // Save the new uploaded image
            $image = $request->input('name');
            $filename = str_replace(' ','',$image . '.' . 'png');
            $store_image = Image::make($request->image)->resize(null, 800, function($constraint) {
                $constraint->aspectRatio();
            });
            $store_image->stream();

            // Save image file in storage folder
            Storage::disk('local')->put('public/images/profiles/' . $filename, $store_image ,'public');
            // Save image name to user DB tabel
            auth()->user()->update(['image' => $filename]);
        }

        // Save your date of birth
        if($request->input('date_of_birth') != null) {
            // Convert to International date format
            $birth = $request->date_of_birth;
            $birthNew = date('Y-m-d', strtotime($birth));
            auth()->user()->update(['date_of_birth' => $birthNew]);
        }

        // Save the form as normal except image
        auth()->user()->update($request->except(['image','date_of_birth']));

        // SWEETALERT
        alert()->success(trans('sweetalert.profile_change_title'),trans('sweetalert.profile_change_text'));
        return back();
        // ->withStatus(__('Profile successfully updated.'))
    }

    /**
     * Change the password
     *
     * @param  \App\Http\Requests\PasswordRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function password(PasswordRequest $request) {
        auth()->user()->update(['password' => Hash::make($request->get('password'))]);

        // SWEETALERT
        alert()->success(trans('sweetalert.password_change_title'),trans('sweetalert.password_change_text'));
        return back();
        // ->withPasswordStatus(__('Password successfully updated.'))
    }

    public function destroyUser($userID) {
        try {
            // Remove profile image
            $filename = auth()->user()->image;
            if(File::exists( public_path('storage/images/profiles/' . $filename))) {
                File::delete( public_path('storage/images/profiles/' . $filename));
            }

            // Remove account
            $user = User::find($userID)->delete();

            // SWEETALERT
            alert()->success(trans('sweetalert.profile_delete_title'),trans('sweetalert.profile_delete_text'));
            return redirect('/');
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}