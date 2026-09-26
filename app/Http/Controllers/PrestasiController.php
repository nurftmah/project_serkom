<?php

namespace App\Http\Controllers;

use App\Models\Prestasi;
use Illuminate\Http\Request;

class PrestasiController extends Controller
{
    // Menampilkan data prestasi
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $prestasis = Prestasi::when($keyword, function ($query) use ($keyword) {

            $query->where('nama_prestasi', 'like', '%' . $keyword . '%')
                  ->orWhere('deskripsi', 'like', '%' . $keyword . '%');

        })
        ->orderBy('tahun_ajaran', 'desc')
        ->get();

        return view('admin.prestasi.index', compact(
            'prestasis',
            'keyword'
        ));
    }


    // Form tambah prestasi
    public function create()
    {
        return view('admin.prestasi.create');
    }


    // Menyimpan data prestasi
    public function store(Request $request)
    {
        $request->validate([
            'nama_prestasi' => 'required|max:40',
            'deskripsi' => 'required',
            'foto' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'tahun_ajaran' => 'required|integer',
        ]);

        $namaFoto = null;

        // Upload foto
        if ($request->hasFile('foto')) {

            $file = $request->file('foto');

            $namaFoto = time() . '_' . $file->getClientOriginalName();

            $file->move(
                public_path('uploads/prestasi'),
                $namaFoto
            );
        }

        // Simpan ke database
        Prestasi::create([
            'nama_prestasi' => $request->nama_prestasi,
            'deskripsi' => $request->deskripsi,
            'foto' => $namaFoto,
            'tahun_ajaran' => $request->tahun_ajaran,
        ]);

        return redirect()
            ->route('admin.prestasi.index')
            ->with('success', 'Data prestasi berhasil ditambahkan.');
    }


    // Form edit
    public function edit($id)
    {
        $prestasi = Prestasi::findOrFail($id);

        return view('admin.prestasi.edit', compact('prestasi'));
    }


    // Update data prestasi
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_prestasi' => 'required|max:40',
            'deskripsi' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'tahun_ajaran' => 'required|integer',
        ]);

        $prestasi = Prestasi::findOrFail($id);

        $namaFoto = $prestasi->foto;

        // Jika upload foto baru
        if ($request->hasFile('foto')) {

            // Hapus foto lama
            if (
                $prestasi->foto &&
                file_exists(
                    public_path('uploads/prestasi/' . $prestasi->foto)
                )
            ) {
                unlink(
                    public_path('uploads/prestasi/' . $prestasi->foto)
                );
            }

            $file = $request->file('foto');

            $namaFoto = time() . '_' . $file->getClientOriginalName();

            $file->move(
                public_path('uploads/prestasi'),
                $namaFoto
            );
        }

        $prestasi->update([
            'nama_prestasi' => $request->nama_prestasi,
            'deskripsi' => $request->deskripsi,
            'foto' => $namaFoto,
            'tahun_ajaran' => $request->tahun_ajaran,
        ]);

        return redirect()
            ->route('admin.prestasi.index')
            ->with('success', 'Data prestasi berhasil diperbarui.');
    }


    // Hapus data prestasi
    public function destroy($id)
    {
        $prestasi = Prestasi::findOrFail($id);

        // Hapus foto
        if (
            $prestasi->foto &&
            file_exists(
                public_path('uploads/prestasi/' . $prestasi->foto)
            )
        ) {
            unlink(
                public_path('uploads/prestasi/' . $prestasi->foto)
            );
        }

        $prestasi->delete();

        return redirect()
            ->route('admin.prestasi.index')
            ->with('success', 'Data prestasi berhasil dihapus.');
    }
}
