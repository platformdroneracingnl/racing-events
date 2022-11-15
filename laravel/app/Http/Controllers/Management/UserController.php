<?php

namespace App\Http\Controllers\Management;

use App;
use App\Http\Controllers\Controller;
use App\Models\Organization;
use App\Models\RaceTeam;
use App\Models\User;
use App\Notifications\ChangeUserAccount;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        // $this->middleware('permission:user-read|user-create|user-update|user-delete', ['only' => ['index', 'show']]);
        // $this->middleware('permission:user-create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:user-update', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:user-delete', ['only' => ['destroy']]);
        $this->authorizeResource(User::class, 'user');
    }

    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $lang = App::getLocale();

        $organization = Organization::with('user');
        $data = User::orderBy('id', 'desc')->get();

        return view('backend.management.users.index', compact('data', 'lang', 'organization'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $organizations = Organization::all();
        $raceTeams = Raceteam::all();
        $roles = Role::pluck('name', 'name')->all();

        return view('backend.management.users.create', compact('roles', 'organizations', 'raceTeams'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required',
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        // Create and asign role
        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        // Mark email of user as verified
        $user->markEmailAsVerified();

        return redirect()->route('management.users.index')
            ->with('success', 'Gebruiker is succesvol aangemaakt');
    }

    /**
     * Display the specified resource.
     *
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('backend.management.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $organizations = Organization::all();
        $raceTeams = RaceTeam::all();
        $roles = Role::pluck('name')->all();

        return view('backend.management.users.edit', compact('user', 'roles', 'organizations', 'raceTeams'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\User  $user
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'password' => 'same:confirm-password',
            'roles' => 'required',
        ]);

        $input = $request->all();
        if (! empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, ['password']);
        }

        $user->update($input);

        DB::table('model_has_roles')->where('model_id', $user->id)->delete();
        $user->assignRole($request->input('roles'));

        // Send user a notification that profile has been changed
        $user->notify(new ChangeUserAccount(route('profile.show')));

        return redirect()->route('management.users.index')
            ->with('success', 'Gebruiker succesvol aangepast');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        // Remove profile image and account
        $this->deleteOldImage('profiles', $user->image);
        $user->delete();

        return redirect()->route('management.users.index')
            ->with('success', 'Gebruiker succesvol verwijderd');
    }

    /**
     * Suspend a user
     *
     * @param \App\Models\User  $user
     * @param  \Illuminate\Http\Request  $request
     */
    public function suspendUser(Request $request, User $user)
    {
        $input = $request->all();

        if ($request == null) {
            // Unsuspend user with null value
            $user->suspended_until = null;
            $user->update();
        } else {
            // Suspend a user with date value
            $user->update($input);
        }

        return redirect()->back();
    }
}
