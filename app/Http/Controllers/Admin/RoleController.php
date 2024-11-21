<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles =  Role::all();
        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('admin.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        request()->validate([
            'name' => ['required', 'unique:roles,name'],
            'permissions' => 'nullable|array',
        ]);

        $rol = Role::create($request->all());

        $rol->permissions()->attach($request->permissions);

        session()->flash('swal', [
            'title' => 'Rol creado',
            'text' => 'El rol se ha creado correctamente',
            'icon' => 'success'
        ]);

        return redirect()->route('admin.roles.index', $rol);
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        return view('admin.roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        // $permissions = $role->permissions->pluck('id')->toArray();
        // dd(in_array(1, $permissions));
        $permissions = Permission::all();
        return view('admin.roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => ['required', 'unique:roles,name,' . $role->id],
            'permissions' => 'nullable|array',
        ]);

        $role->update($request->all());

        $role->permissions()->sync($request->permissions);

        session()->flash('swal', [
            'title' => 'Rol actualizado',
            'text' => 'El rol se ha actualizado correctamente',
            'icon' => 'success'
        ]);
        return redirect()->route('admin.roles.edit', $role);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        //return $role->id;
        // DB::table('roles')->where('id', $role->id)->delete();
        //No funciona // Ya funciona, cuidado con el archivo app
        $role->delete(); // Eliminar el registro
        //$role->destroy($role->id); // Eliminar el registro

        session()->flash('swal', [
            'title' => 'Rol eliminado',
            'text' => 'El rol se ha eliminado correctamente',
            'icon' => 'success'
        ]);

        return redirect()->route('admin.roles.index');
    }
}
