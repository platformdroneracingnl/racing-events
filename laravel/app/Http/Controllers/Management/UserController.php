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
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
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
     * Display a listing of the users.
     */
    public function index(Request $request): View
    {
        $lang = App::getLocale();

        $organization = Organization::with('user');
        $data = User::orderBy('id', 'desc')->get();

        return view('backend.management.users.index', compact('data', 'lang', 'organization'));
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user): View
    {
        return view('backend.management.users.show', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $organizations = Organization::all();
        $raceTeams = Raceteam::all();
        $roles = Role::pluck('name', 'name')->all();

        return view('backend.management.users.create', compact('roles', 'organizations', 'raceTeams'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request): RedirectResponse
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
     */
    public function edit(User $user): View
    {
        $organizations = Organization::all();
        $raceTeams = RaceTeam::all();
        $roles = Role::pluck('name')->all();

        return view('backend.management.users.edit', compact('user', 'roles', 'organizations', 'raceTeams'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user): RedirectResponse
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
     */
    public function destroy(User $user): RedirectResponse
    {
        // Remove profile image and account
        $this->deleteOldImage('profiles', $user->image);
        $user->delete();

        return redirect()->route('management.users.index')
            ->with('success', 'Gebruiker succesvol verwijderd');
    }

    /**
     * Suspend a user
     */
    public function suspendUser(Request $request, User $user): RedirectResponse
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
