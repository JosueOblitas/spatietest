<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }
    public function show(User $user)
    {
        $roles = Role::all();
        $permissions = Permission::all();
        return view('admin.users.role', compact('user', 'roles', 'permissions'));
    }
    public function destroy(User $user)
    {
        $user->delete();
        return back()->success('Usuario eliminado correctamente');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return back()->success('Usuario creado con exito');
    }
    //Usuario - Role
    public function asignarRole(Request $request, User $user)
    {
        if ($user->hasRole($request->role)) {
            return back()->info('El rol ya esta asignado');
        }
        $user->assignRole($request->role);
        return back()->success('Rol creado con exito');
    }
    public function revocarRole(User $user, Role $role)
    {
        if ($user->hasRole($role)) {
            $user->removeRole($role);
            return back()->success('El rol fue revocado correctamente');
        }
        return back()->info('El rol no existe');
    }

    //Usuario - Permission
    public function AsignarPermiso(Request $request, User $user)
    {
        if ($user->hasPermissionTo($request->permission)) {
            return back()->info('El permiso ya esta asignado');
        }
        $user->givePermissionTo($request->permission);
        return back()->success('Permiso asignado con exito');
    }
    public function revocarPermiso(User $user, Permission $permission)
    {
        if ($user->hasPermissionTo($permission)) {
            $user->revokePermissionTo($permission);
            return back()->success('El permiso fue revocado correctamente');
        }
        return back()->info('El permiso no existe');
    }

}