<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class UserController extends Controller
{
    // =========================
    // MENAMPILKAN DATA USER
    // =========================
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');

        // Gunakan query builder dengan grouping (function) agar pencarian orWhere tidak bocor
        $users = User::when($keyword, function ($query) use ($keyword) {
                    return $query->where(function ($q) use ($keyword) {
                        $q->where('username', 'like', "%{$keyword}%")
                        ->orWhere('role', 'like', "%{$keyword}%");
                    });
                })
                ->latest()
                ->get();

        $totalUser = User::count();
        $totalAdmin = User::where('role', 'Admin')->count();
        $totalOperator = User::where('role', 'Operator')->count();

        return view('admin.user.index', compact(
            'users',
            'totalUser',
            'totalAdmin',
            'totalOperator',
            'keyword'
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
        $id = Crypt::decryptString($id);
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
        $id = Crypt::decryptString($id);
        $user = User::findOrFail($id);

        $user->delete();

        return redirect()
            ->route('admin.user.index')
            ->with('success', 'Akun berhasil dihapus!');
    }

    // PROFIL AKUN YANG SEDANG LOGIN
    public function profile()
    {
        $userId = Auth::id();
        $user = User::findOrFail($userId);
        return view('admin.user.profil', compact('user'));
    }


    // UPDATE PROFIL AKUN
    public function updateProfile(Request $request)
    {
        $userId = Auth::id();

        $user = User::findOrFail($userId);

        $request->validate([
            'username' => [
                'required',
                'max:30',
                'unique:users,username,' . $user->id,
            ],
        ]);

        $user->username = $request->username;

        if ($request->filled('password')) {

            $request->validate([
                'password' => 'min:6|confirmed',
            ]);
            $user->password = $request->password;
        }
        $user->save();

        return redirect()
            ->route('admin.user.profil')
            ->with('success', 'Profil akun berhasil diperbarui.');
    }
}
