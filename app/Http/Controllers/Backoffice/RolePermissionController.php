<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionController extends Controller
{
    public function index(Request $request)
    {
        $roles = Role::orderBy('name')->get();
        $permissions = Permission::orderBy('name')->get();

        $selectedRole = null;
        $rolePermissions = [];

        if ($request->filled('role_id')) {
            $selectedRole = Role::find($request->role_id);

            if ($selectedRole) {
                $rolePermissions = $selectedRole->permissions
                    ->pluck('name')
                    ->toArray();
            }
        }

        return view('backoffice.roles.index', compact(
            'roles',
            'permissions',
            'selectedRole',
            'rolePermissions'
        ));
    }

    public function storeRole(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:roles,name',
        ]);

        Role::create([
            'name' => $request->name,
            'guard_name' => 'web',
        ]);

        return back()->with('success', 'Role berhasil ditambahkan.');
    }

    public function storePermission(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:permissions,name',
        ]);

        Permission::create([
            'name' => $request->name,
            'guard_name' => 'web',
        ]);

        return back()->with('success', 'Permission berhasil ditambahkan.');
    }

    public function syncPermission(Request $request)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
            'permissions' => 'nullable|array',
        ]);

        $role = Role::findOrFail($request->role_id);

        $role->syncPermissions($request->permissions ?? []);

        return redirect()
            ->route('admin.backoffice.role-permission.index', ['role_id' => $role->id])
            ->with('success', 'Permission role berhasil diperbarui.');
    }
}