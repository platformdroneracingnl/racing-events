<?php

namespace App\Http\Controllers\Management;

use App;
use App\Http\Controllers\Controller;
use App\Http\Requests\Management\StoreUserRequest;
use App\Http\Requests\Management\UpdateUserRequest;
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
     * Display the specified resource.
     *
     * @return \Illuminate\View\View
     */
    public function show(User $user)
    {
        return view('backend.management.users.show', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreUserRequest $request)
    {
        $input = $request->validated();
        $input['password'] = Hash::make($input['password']);

        // Create and asign role
        $user = User::create($input);
        $user->assignRole($request->validated('roles'));

        // Mark email of user as verified
        $user->markEmailAsVerified();

        return redirect()->route('management.users.index')
            ->with('success', 'Gebruiker is succesvol aangemaakt');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\View\View
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $input = $request->validated();

        // Update the password if it is not empty
        if (! empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, ['password']);
        }
        $user->update($input);

        DB::table('model_has_roles')->where('model_id', $user->id)->delete();
        $user->assignRole($request->validated('roles'));

        // Send user a notification that profile has been changed
        $user->notify(new ChangeUserAccount(route('profile.show')));

        return redirect()->route('management.users.index')
            ->with('success', 'Gebruiker succesvol aangepast');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\RedirectResponse
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function suspendUser(Request $request, User $user)
    {
        $this->authorize('suspend', User::class);

        if ($request->suspended_until == null) {
            // Unsuspend user with null value
            $user->update(['suspended_until' => null]);
        } else {
            // Suspend a user with date value
            $user->update([
                'suspended_until' => $request->suspended_until,
            ]);
        }

        return redirect()->back();
    }
}
