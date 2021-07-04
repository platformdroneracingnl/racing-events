<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Organization;
use App\Models\User;
use App;

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
        $raceTeams = Raceteam::all();
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();

        return view('management.users.edit', compact('user','roles','userRole','organizations','raceTeams'));
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
