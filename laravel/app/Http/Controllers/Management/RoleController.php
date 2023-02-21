<?php

namespace App\Http\Controllers\Management;

use App;
use App\Http\Controllers\Controller;
use App\Http\Requests\Management\StoreRoleRequest;
use App\Http\Requests\Management\UpdateRoleRequest;
use DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        // Check if user has required permission
        $this->authorize('role-read');

        $lang = App::getLocale();
        $roles = Role::orderBy('id', 'ASC')->get();

        return view('backend.management.roles.index', compact('roles', 'lang'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role): View
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
     */
    public function create(): View
    {
        // Check if user has required permission
        $this->authorize('role-create');

        $permission = Permission::get();

        return view('backend.management.roles.create', compact('permission'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request): RedirectResponse
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
     */
    public function edit(Role $role): View
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
     */
    public function update(UpdateRoleRequest $request, Role $role): RedirectResponse
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
     */
    public function destroy(int $id): RedirectResponse
    {
        // Check if user has required permission
        $this->authorize('role-delete');

        DB::table('roles')->where('id', $id)->delete();

        return redirect()->route('management.roles.index')
            ->with('success', 'Rol is succesvol verwijderd');
    }
}
