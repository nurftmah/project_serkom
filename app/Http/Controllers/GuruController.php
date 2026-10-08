<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

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

    public function publicIndex()
{
    $gurus = Guru::orderBy('nama_guru', 'asc')->get();

    return view('landing.guru', compact('gurus'));
}

public function show($id)
{
    try {
        $idGuru = Crypt::decryptString($id);

        $guru = Guru::where('id_guru', $idGuru)->first();

        if (!$guru) {
            return redirect()
                ->route('guru.public')
                ->with('error', 'Data guru tidak ditemukan.');
        }

        return view('landing.detail-guru', compact('guru'));

    } catch (DecryptException $e) {
        return redirect()
            ->route('guru.public')
            ->with('error', 'Data guru tidak ditemukan.');
    }
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
        try {
            $id = Crypt::decryptString($id);
            $guru = Guru::find($id);

            // Kalau data guru tidak ada
            if (!$guru) {
                return redirect()
                    ->route('admin.guru.index')
                    ->with('error', 'Data guru tidak ditemukan.');
            }

            return view('admin.guru.edit', compact('guru'));

        } catch (DecryptException $e) {

            // Kalau ID di URL rusak / dihapus / diubah
            return redirect()->route('admin.guru.index')->with('error', 'Data guru tidak ditemukan.');
        }
    }


    // =========================
    // UPDATE DATA GURU
    // =========================
    public function update(Request $request, $id)
    {
        try {
            // Decrypt ID dari URL
            $id = Crypt::decryptString($id);

            // Cari data guru
            $guru = Guru::find($id);

            // Jika data guru tidak ditemukan
            if (!$guru) {
                return redirect()->route('admin.guru.index')->with('error', 'Data guru tidak ditemukan.');
            }

            // Validasi
            $request->validate([
                'nama_guru' => 'required|max:40',
                'nip' => 'required|max:15',
                'mapel' => 'required|max:40',
                'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            ]);

            // Foto lama
            $namaFoto = $guru->foto;


            // =========================
            // JIKA UPLOAD FOTO BARU
            // =========================
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


            // =========================
            // UPDATE DATABASE
            // =========================
            $guru->update([
                'nama_guru' => $request->nama_guru,
                'nip' => $request->nip,
                'mapel' => $request->mapel,
                'foto' => $namaFoto,
            ]);


            // Kembali ke data guru
            return redirect()
                ->route('admin.guru.index')
                ->with('success', 'Data guru berhasil diperbarui.');


        } catch (DecryptException $e) {

            // Jika ID di URL rusak / tidak valid
            return redirect()->route('admin.guru.index')->with('error', 'Data guru tidak ditemukan.');
        }
    }


    // =========================
    // HAPUS DATA GURU
    // =========================
    public function destroy($id)
    {
        try {

            // Decrypt ID dari URL
            $id = Crypt::decryptString($id);

            // Cari data guru
            $guru = Guru::find($id);

            // Jika data guru tidak ditemukan
            if (!$guru) {
                return redirect()->route('admin.guru.index')->with('error', 'Data guru tidak ditemukan.');
            }


            // =========================
            // HAPUS FOTO
            // =========================
            if (
                $guru->foto &&
                file_exists(public_path('uploads/guru/' . $guru->foto))
            ) {
                unlink(
                    public_path('uploads/guru/' . $guru->foto)
                );
            }


            // =========================
            // HAPUS DATA
            // =========================
            $guru->delete();


            // Berhasil
            return redirect()
                ->route('admin.guru.index')
                ->with('success', 'Data guru berhasil dihapus.');


        } catch (DecryptException $e) {

            // Jika ID terenkripsi rusak / diubah / dihapus
            return redirect()->route('admin.guru.index')->with('error', 'Data guru tidak ditemukan.');
        }
    }
}
