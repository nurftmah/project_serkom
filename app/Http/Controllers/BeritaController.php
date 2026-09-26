<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    // Menampilkan data berita
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $beritas = Berita::when($keyword, function ($query) use ($keyword) {
            $query->where('judul', 'like', '%' . $keyword . '%')
                  ->orWhere('isi', 'like', '%' . $keyword . '%');
        })
        ->orderBy('tanggal', 'desc')
        ->get();

        return view('admin.berita.index', compact('beritas', 'keyword'));
    }


    // Menampilkan form tambah berita
    public function create()
    {
        return view('admin.berita.create');
    }


    // Menyimpan berita
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|max:50',
            'isi' => 'required',
            'tanggal' => 'required|date',
            'gambar' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'status' => 'required|in:Publish,Draft',
        ]);

        // Upload gambar
        $namaGambar = null;

        if ($request->hasFile('gambar')) {

            $file = $request->file('gambar');

            $namaGambar = time() . '_' . $file->getClientOriginalName();

            $file->move(
                public_path('uploads/berita'),
                $namaGambar
            );
        }

        // Simpan berita
        Berita::create([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'tanggal' => $request->tanggal,
            'gambar' => $namaGambar,
            'status' => $request->status,

            // ID user yang ada di database
            'id_user' => 2,
        ]);

        return redirect()
            ->route('admin.berita.index')
            ->with('success', 'Berita berhasil ditambahkan.');
    }


    // Menampilkan form edit
    public function edit($id)
    {
        $berita = Berita::findOrFail($id);

        return view('admin.berita.edit', compact('berita'));
    }


    // Mengupdate berita
    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|max:50',
            'isi' => 'required',
            'tanggal' => 'required|date',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status' => 'required|in:Publish,Draft',
        ]);

        $berita = Berita::findOrFail($id);

        $namaGambar = $berita->gambar;

        // Jika upload gambar baru
        if ($request->hasFile('gambar')) {

            $file = $request->file('gambar');

            $namaGambar = time() . '_' . $file->getClientOriginalName();

            $file->move(
                public_path('uploads/berita'),
                $namaGambar
            );
        }

        $berita->update([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'tanggal' => $request->tanggal,
            'gambar' => $namaGambar,
            'status' => $request->status,

            // Tetap menggunakan user ID 3
            'id_user' => 3,
        ]);

        return redirect()
            ->route('admin.berita.index')
            ->with('success', 'Berita berhasil diperbarui.');
    }


    // Menghapus berita
    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);

        $berita->delete();

        return redirect()
            ->route('admin.berita.index')
            ->with('success', 'Berita berhasil dihapus.');
    }
}
