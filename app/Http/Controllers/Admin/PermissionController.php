<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{

    public function index()
    {
        $permissions = Permission::all();
        return view('admin.permissions.index',compact('permissions'));
    }
    public function create(){
        return view('admin.permissions.create');
    }
    public function store(Request $request){
        try{
            $validated = $request->validate(["name" => ["required","min:3"]]);
            Permission::create($validated);
    
            return to_route('admin.permissions.index')->success("Permiso creado correctamente");
        }catch(\Exception $e){
            return to_route('admin.permissions.index')->error("Hubo un error al crear el permiso (ver logs)");
        }
    }
    public function edit(Permission $permission){
        $roles = Role::all();
        return view('admin.permissions.edit',compact('permission','roles'));
    }
    public function update(Request $request,Permission $permission){
        $validated = $request->validate(["name" =>["required","min:3", "unique:permissions,name," . $permission->id]]);
        $permission->update($validated);
        return to_route('admin.permissions.index')->success("Permiso Actualizado correctamente");
    }
    public function destroy(Permission $permission){
        $permission->delete();
        return to_route('admin.permissions.index')->success("Permiso eliminado correctamente");
    }
    public function asignarRole(Request $request,Permission $permission){
        if($permission->hasRole($request->role)){
            return back()->info('El rol ya esta asignado');
        }
        $permission->assignRole($request->role);
        return back()->success('Rol asignado con exito');
    }
    public function revocarPermiso(Permission $permission ,Role $role){
        if($permission->hasRole($role)){
            $permission->removeRole($role);
            return back()->success('El rol fue revocado correctamente');
        }
        return back()->info('El rol no existe');
    }
}