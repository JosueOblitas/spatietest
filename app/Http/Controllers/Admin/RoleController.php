<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::whereNotIn('name',['admin'])->get();
        return view('admin.roles.index',compact('roles'));
    }
    public function  create(){
        return view('admin.roles.create');
    }
    public function store(Request $request){
        $validated = $request->validate(['name' => ['required','min:3']]);
        Role::create($validated);
        return to_route('admin.roles.index');
    }
    public function edit(Role $role){
        $permissions = Permission::all();
        return view('admin.roles.edit',compact('role','permissions'));
    }
    public function update(Request $request,Role $role){
        $validated = $request->validate(["name" => ["required","min:3", "unique:roles,name," . $role->id]]);
        $role->update($validated);
        return to_route('admin.roles.index')->success("Rol eliminado correctamente");
    }
    public function destroy(Role $role){
        $role->delete();
        return to_route('admin.roles.index')->success("El rol fue eliminado correctamente");
    }
    public function asignarPermiso(Request $request,Role $role){
        if($role->hasPermissionTo($request->permission)){
            return back()->info("El rol ya tiene agregado este permiso");
        }
        $role->givePermissionTo($request->permission);
        return back()->success("Permiso agregado correctamente");
    }
    public function revocarPermiso(Role $role,Permission $permission){
        if($role->hasPermissionTo($permission)){
            $role->revokePermissionTo($permission);
            return back()->success("El permiso fue revocado");
        }
        return back()->warning("El permiso no existe");
    }
}