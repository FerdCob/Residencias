<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::paginate();
        $hoteles = Hotel::all();

        return view('admin.users.index', compact('users', 'hoteles'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        $hoteles = Hotel::all();

        return view('admin.users.edit', compact('user', 'roles', 'hoteles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {

        // return $request;
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => "required|string|email|max:255|unique:users,email,{$user->id}",
            'idHotel' => 'exists:hoteles,idHotel',
            // 'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->idHotel = $request->idHotel;

        // if ($user->password) {
        //     $user->password = bcrypt($request->password);
        // }

        $user->roles()->sync($request->roles);

        $user->save();

        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Bien hecho!',
            'text' => 'El usuario se actualizó correctamente.',
        ]);

        return redirect()->route('admin.users.edit', $user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
