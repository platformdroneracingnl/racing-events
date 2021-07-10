<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Notifications\ChangeUserAccount;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Models\Organization;
use App\Models\RaceTeam;
use App\Models\User;
use App;
use DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct() {
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index','show']]);
        $this->middleware('permission:user-create', ['only' => ['create','store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */
    public function index(Request $request) {
        $lang = App::getLocale();
        $organization = Organization::with('user');
        $data = User::orderBy('id','desc')->get();

        return view('backend.management.users.index', compact('data','lang','organization'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $organizations = Organization::all();
        $raceTeams = Raceteam::all();
        $roles = Role::pluck('name','name')->all();
        return view('backend.management.users.create', compact('roles','organizations','raceTeams'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $user = User::find($id);
        return view('backend.management.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $user = User::find($id);
        $organizations = Organization::all();
        $raceTeams = RaceTeam::all();
        $roles = Role::pluck('name')->all();

        return view('backend.management.users.edit', compact('user','roles','organizations','raceTeams'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        if(!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input,array('password'));
        }

        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();

        $user->assignRole($request->input('roles'));

        // Send user a notification that profile has been changed
        $user->notify(new ChangeUserAccount(route('profile.show')));

        return redirect()->route('management.users.index')
            ->with('success','Gebruiker succesvol aangepast');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        User::find($id)->delete();
        return redirect()->route('management.users.index')
            ->with('success','Gebruiker succesvol verwijderd');
    }

    // Suspend a user
    public function suspendUser(Request $request, $id) {
        $input = $request->all();
        $user = User::find($id);

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
