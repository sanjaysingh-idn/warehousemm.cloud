<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $role = ['superadmin', 'manager', 'admin', 'karyawan'];

        return view('user.index', [
            'title'     => 'Daftar Akun',
            'users'     => User::all(),
            'role'      => $role,
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $attr = $request->validate([
            'name'          => 'required|max:255',
            'jabatan'       => 'required',
            'role'          => 'required',
            'email'         => 'required|email:dns|max:150|unique:users,email',
            'password'      => 'required|string|min:8|max:255',
        ]);

        $attr['password'] = Hash::make($request->password);

        User::create($attr);

        return back()->with('message', 'User berhasil ditambah');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $user = User::findOrFail($id)->get();
        $role = ['superadmin', 'manager', 'admin', 'karyawan'];
        return view('user.edit' . [
            'title'     => 'Edit User',
            'user'      => $user,
            'role'      => $role,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'jabatan'       => 'required',
            'role'          => 'required',
            'email'         => 'required|email:dns|max:255|unique:users,email,' . $id,
            'password'      => 'nullable|string|min:8|max:255',
        ]);

        $userData = [
            'name'          => $request->input('name'),
            'email'         => $request->input('email'),
            'jabatan'       => $request->input('jabatan'),
            'role'          => $request->input('role'),
        ];

        if ($request->filled('password')) {
            $userData['password'] = Hash::make($request->input('password'));
        }

        $user = User::findOrFail($id);
        $user->update($userData);

        return back()->with('message', 'User berhasil di update');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return back()->with('message_delete', 'User berhasil dihapus');
    }
}
