<?php

namespace App\Http\Controllers;

use App\Models\LoginSecurity;
use Auth;
use Hash;
use Illuminate\Http\Request;
use PragmaRX\Google2FAQRCode\Google2FA;

class LoginSecurityController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Generate 2FA secret key
     */
    public function generate2faSecret(Request $request)
    {
        $user = Auth::user();

        // Initialise the 2FA class
        $google2fa = new Google2FA();

        // Add the secret key to the registration data
        $login_security = LoginSecurity::firstOrNew(['user_id' => $user->id]);
        $login_security->user_id = $user->id;
        $login_security->google2fa_enable = 0;
        $login_security->google2fa_secret = $google2fa->generateSecretKey();
        $login_security->save();

        return redirect('profile#authentication')->with('success', trans('category/profile.create_secret_key'));
    }

    /**
     * Enable 2FA
     */
    public function enable2fa(Request $request)
    {
        $user = Auth::user();
        $google2fa = new Google2FA();

        $secret = $request->input('secret');
        $valid = $google2fa->verifyKey($user->loginSecurity->google2fa_secret, $secret);

        if ($valid) {
            $user->loginSecurity->google2fa_enable = 1;
            $user->loginSecurity->save();

            return redirect('profile#authentication')->with('success', trans('category/profile.2fa_enabled'));
        } else {
            return redirect('profile#authentication')->with('error', trans('category/profile.2fa_wrong_code'));
        }
    }

    /**
     * Disable 2FA
     */
    public function disable2fa(Request $request)
    {
        if (! (Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect('profile#authentication')->with('error', trans('category/profile.2fa_wrong_password'));
        }

        $validatedData = $request->validate([
            'current-password' => 'required',
        ]);
        $user = Auth::user();
        $user->loginSecurity->delete();

        return redirect('profile#authentication')->with('success', trans('category/profile.2fa_disabled'));
    }
}
