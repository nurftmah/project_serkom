<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use App\Models\User;
use Illuminate\Http\Request;

class PengumumanController extends Controller
{
    // Menampilkan semua pengumuman
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $pengumumans = Pengumuman::when($keyword, function ($query) use ($keyword) {
            $query->where('judul', 'like', '%' . $keyword . '%')
                  ->orWhere('isi', 'like', '%' . $keyword . '%');
        })
        ->orderBy('tanggal', 'desc')
        ->get();

        return view('admin.pengumuman.index', compact('pengumumans', 'keyword'));
    }


    // Menampilkan form tambah
    public function create()
    {
        return view('admin.pengumuman.create');
    }


    // Menyimpan pengumuman
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|max:50',
            'isi' => 'required',
            'tanggal' => 'required|date',
            'status' => 'required|in:Publish,Draft',
        ]);

        // Ambil user pertama yang tersedia
        $user = User::first();

        if (!$user) {
            return back()->with('error', 'Data user belum tersedia.');
        }

        Pengumuman::create([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'tanggal' => $request->tanggal,
            'status' => $request->status,
            'id_user' => $user->id,
        ]);

        return redirect()
            ->route('admin.pengumuman.index')
            ->with('success', 'Pengumuman berhasil ditambahkan.');
    }


    // Menampilkan form edit
    public function edit($id)
    {
        $pengumuman = Pengumuman::findOrFail($id);

        return view('admin.pengumuman.edit', compact('pengumuman'));
    }


    // Mengupdate pengumuman
    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|max:50',
            'isi' => 'required',
            'tanggal' => 'required|date',
            'status' => 'required|in:Publish,Draft',
        ]);

        $pengumuman = Pengumuman::findOrFail($id);

        $pengumuman->update([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'tanggal' => $request->tanggal,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('admin.pengumuman.index')
            ->with('success', 'Pengumuman berhasil diperbarui.');
    }


    // Menghapus pengumuman
    public function destroy($id)
    {
        $pengumuman = Pengumuman::findOrFail($id);

        $pengumuman->delete();

        return redirect()
            ->route('admin.pengumuman.index')
            ->with('success', 'Pengumuman berhasil dihapus.');
    }
}
