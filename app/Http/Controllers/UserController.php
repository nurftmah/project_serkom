<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // =========================
    // MENAMPILKAN DATA USER
    // =========================
    public function index()
    {
        $users = User::latest()->get();

        $totalUser = $users->count();

        $totalAdmin = $users->where('role', 'Admin')->count();

        $totalOperator = $users->where('role', 'Operator')->count();

        return view('admin.user.index', compact(
            'users',
            'totalUser',
            'totalAdmin',
            'totalOperator'
        ));
    }


    // =========================
    // FORM TAMBAH USER
    // =========================
    public function create()
    {
        return view('admin.user.create');
    }


    // =========================
    // SIMPAN USER BARU
    // =========================
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|max:30|unique:users,username',
            'password' => 'required|min:6|confirmed',
            'role' => 'required|in:Admin,Operator',
        ]);

        User::create([
            'username' => $request->username,

            // Password akan otomatis di-hash
            // karena User.php menggunakan cast hashed
            'password' => $request->password,

            'role' => $request->role,
        ]);

        return redirect()
            ->route('admin.user.index')
            ->with('success', 'Akun berhasil ditambahkan!');
    }


    // =========================
    // FORM EDIT USER
    // =========================
    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('admin.user.edit', compact('user'));
    }


    // =========================
    // UPDATE USER
    // =========================
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'username' => 'required|max:30|unique:users,username,' . $id,
            'role' => 'required|in:Admin,Operator',
        ]);

        // Update username
        $user->username = $request->username;

        // Update role
        $user->role = $request->role;

        // Jika password diisi, maka password ikut diubah
        if ($request->filled('password')) {

            $request->validate([
                'password' => 'min:6|confirmed',
            ]);

            // Otomatis di-hash oleh cast di User.php
            $user->password = $request->password;
        }

        $user->save();

        return redirect()
            ->route('admin.user.index')
            ->with('success', 'Akun berhasil diubah!');
    }


    // =========================
    // HAPUS USER
    // =========================
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return redirect()
            ->route('admin.user.index')
            ->with('success', 'Akun berhasil dihapus!');
    }
}
