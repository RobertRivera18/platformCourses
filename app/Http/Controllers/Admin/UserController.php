<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
        return view('admin.users.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed'
        ]);

        User::create($data);
        return redirect()->route('admin.users.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6|confirmed'
        ]);
        $user->name = $data['name'];
        $user->email = $data["email"];
        if ($data["password"]) {

            $user->password = bcrypt($data["password"]);
        }
        $user->save();
        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Usuario Actualizado',
            'text' => 'El Usuario se ha actualizado Correctamente'
        ]);
        return redirect()->route('admin.users.edit', $user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        session()->flash('swal', [
            'title' => "Usuario Eliminado",
            'text' => "El Usuario se eliminó correctamente.",
            'icon' => "success",
            'showConfirmButton' => false,
            'timer' => 1500,
            'customClass' => [
                'popup' => "minimalist-alert",
                'title' => "minimalist-alert-title"
            ]
        ]);

        return redirect()->route('admin.users.index');
    }
}
