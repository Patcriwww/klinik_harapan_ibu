<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionController extends Controller
{
    public function index()
    {
        $roles = Role::with('permissions')->get();

        return view('admin.backoffice.roles.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::all();

        return view('admin.backoffice.roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
            'permissions' => 'array',
        ]);

        $role = Role::create([
            'name' => $request->name,
            'guard_name' => 'web',
        ]);

        $role->syncPermissions($request->permissions ?? []);

        return redirect()
            ->route('backoffice.roles.index')
            ->with('success', 'Role berhasil ditambahkan.');
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all();

        return view('admin.backoffice.roles.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,' . $role->id,
            'permissions' => 'array',
        ]);

        $role->update([
            'name' => $request->name,
        ]);

        $role->syncPermissions($request->permissions ?? []);

        return redirect()
            ->route('backoffice.roles.index')
            ->with('success', 'Role berhasil diperbarui.');
    }

    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()
            ->route('backoffice.roles.index')
            ->with('success', 'Role berhasil dihapus.');
    }
}