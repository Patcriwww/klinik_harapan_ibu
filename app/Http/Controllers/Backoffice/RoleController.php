<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::with('permissions')->orderBy('name')->get();
        $permissions = Permission::orderBy('name')->get();

        $totalRoles = Role::count();
        $totalPermissions = Permission::count();
        $totalRolePermissions = $roles->sum(fn($role) => $role->permissions->count());

        return view('backoffice.roles.index', compact(
            'roles',
            'permissions',
            'totalRoles',
            'totalPermissions',
            'totalRolePermissions'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:roles,name',
        ]);

        Role::create([
            'name' => strtolower(str_replace(' ', '_', $request->name)),
            'guard_name' => 'web',
        ]);

        return redirect()
            ->route('admin.backoffice.roles.index')
            ->with('success', 'Role berhasil ditambahkan.');
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|string|unique:roles,name,' . $role->id,
        ]);

        $role->update([
            'name' => strtolower(str_replace(' ', '_', $request->name)),
        ]);

        return redirect()
            ->route('admin.backoffice.roles.index')
            ->with('success', 'Role berhasil diperbarui.');
    }

    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()
            ->route('admin.backoffice.roles.index')
            ->with('success', 'Role berhasil dihapus.');
    }

    public function syncPermissions(Request $request, Role $role)
    {
        $role->syncPermissions($request->permissions ?? []);

        return redirect()
            ->route('admin.backoffice.roles.index')
            ->with('success', 'Permission role berhasil diperbarui.');
    }
}