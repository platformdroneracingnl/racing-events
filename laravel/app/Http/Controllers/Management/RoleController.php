<?php

namespace App\Http\Controllers\Management;

use App;
use App\Http\Controllers\Controller;
use App\Http\Requests\Management\StoreRoleRequest;
use App\Http\Requests\Management\UpdateRoleRequest;
use DB;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Check if user has required permission
        $this->authorize('role-read');

        $lang = App::getLocale();
        $roles = Role::orderBy('id', 'ASC')->get();

        return view('backend.management.roles.index', compact('roles', 'lang'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\View\View
     */
    public function show(Role $role)
    {
        // Check if user has required permission
        $this->authorize('role-read');

        $rolePermissions = Permission::join('role_has_permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')
            ->where('role_has_permissions.role_id', $role->id)
            ->get();

        return view('backend.management.roles.show', compact('role', 'rolePermissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Check if user has required permission
        $this->authorize('role-create');

        $permission = Permission::get();

        return view('backend.management.roles.create', compact('permission'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Management\StoreRoleRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRoleRequest $request)
    {
        // Check if user has required permission
        $this->authorize('role-create');

        $role = Role::create(['name' => $request->validated('name')]);
        $role->syncPermissions($request->validated('permission'));

        return redirect()->route('management.roles.index')
            ->with('success', 'Rol is succesvol aangemaakt');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\View\View
     */
    public function edit(Role $role)
    {
        // Check if user has required permission
        $this->authorize('role-update');

        $permission = Permission::get();
        $rolePermissions = DB::table('role_has_permissions')->where('role_has_permissions.role_id', $role->id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();

        return view('backend.management.roles.edit', compact('role', 'permission', 'rolePermissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Management\UpdateRoleRequest  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        // Check if user has required permission
        $this->authorize('role-update');

        $role->update(['name' => $request->validated('name')]);
        $role->syncPermissions($request->validated('permission'));

        return redirect()->route('management.roles.index')
            ->with('success', 'Rol is succesvol bijgewerkt');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // Check if user has required permission
        $this->authorize('role-delete');

        DB::table('roles')->where('id', $id)->delete();

        return redirect()->route('management.roles.index')
            ->with('success', 'Rol is succesvol verwijderd');
    }
}
