<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    // =========================
    // MENAMPILKAN DATA GURU
    // =========================
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $gurus = Guru::when($keyword, function ($query) use ($keyword) {

            $query->where('nama_guru', 'like', '%' . $keyword . '%')
                  ->orWhere('nip', 'like', '%' . $keyword . '%')
                  ->orWhere('mapel', 'like', '%' . $keyword . '%');

        })
        ->orderBy('nama_guru', 'asc')
        ->get();

        return view('admin.guru.index', compact('gurus', 'keyword'));
    }


    // =========================
    // FORM TAMBAH GURU
    // =========================
    public function create()
    {
        return view('admin.guru.create');
    }


    // =========================
    // SIMPAN DATA GURU
    // =========================
    public function store(Request $request)
    {
        $request->validate([
            'nama_guru' => 'required|max:40',
            'nip' => 'required|max:15',
            'mapel' => 'required|max:40',
            'foto' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);


        // Membuat folder jika belum ada
        if (!file_exists(public_path('uploads/guru'))) {
            mkdir(public_path('uploads/guru'), 0777, true);
        }


        // Upload foto
        $namaFoto = null;

        if ($request->hasFile('foto')) {

            $foto = $request->file('foto');

            $namaFoto = time() . '_' . $foto->getClientOriginalName();

            $foto->move(
                public_path('uploads/guru'),
                $namaFoto
            );
        }


        // Simpan ke database
        Guru::create([
            'nama_guru' => $request->nama_guru,
            'nip' => $request->nip,
            'mapel' => $request->mapel,
            'foto' => $namaFoto,
        ]);


        return redirect()
            ->route('admin.guru.index')
            ->with('success', 'Data guru berhasil ditambahkan.');
    }


    // =========================
    // FORM EDIT GURU
    // =========================
    public function edit($id)
    {
        $guru = Guru::findOrFail($id);

        return view('admin.guru.edit', compact('guru'));
    }


    // =========================
    // UPDATE DATA GURU
    // =========================
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_guru' => 'required|max:40',
            'nip' => 'required|max:15',
            'mapel' => 'required|max:40',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);


        $guru = Guru::findOrFail($id);


        // Data awal
        $namaFoto = $guru->foto;


        // Jika upload foto baru
        if ($request->hasFile('foto')) {

            // Hapus foto lama
            if (
                $guru->foto &&
                file_exists(public_path('uploads/guru/' . $guru->foto))
            ) {
                unlink(
                    public_path('uploads/guru/' . $guru->foto)
                );
            }


            // Upload foto baru
            $foto = $request->file('foto');

            $namaFoto = time() . '_' . $foto->getClientOriginalName();

            $foto->move(
                public_path('uploads/guru'),
                $namaFoto
            );
        }


        // Update database
        $guru->update([
            'nama_guru' => $request->nama_guru,
            'nip' => $request->nip,
            'mapel' => $request->mapel,
            'foto' => $namaFoto,
        ]);


        return redirect()
            ->route('admin.guru.index')
            ->with('success', 'Data guru berhasil diperbarui.');
    }


    // =========================
    // HAPUS DATA GURU
    // =========================
    public function destroy($id)
    {
        $guru = Guru::findOrFail($id);


        // Hapus foto
        if (
            $guru->foto &&
            file_exists(public_path('uploads/guru/' . $guru->foto))
        ) {
            unlink(
                public_path('uploads/guru/' . $guru->foto)
            );
        }


        // Hapus data
        $guru->delete();


        return redirect()
            ->route('admin.guru.index')
            ->with('success', 'Data guru berhasil dihapus.');
    }
}
