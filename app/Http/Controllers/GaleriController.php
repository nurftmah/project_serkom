<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    // MENAMPILKAN DATA GALERI
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $galeris = Galeri::when($keyword, function ($query) use ($keyword) {

            $query->where('judul', 'like', '%' . $keyword . '%')
                  ->orWhere('kategori', 'like', '%' . $keyword . '%');

        })
        ->orderBy('tanggal', 'desc')
        ->get();

        return view('admin.galeri.index', compact('galeris', 'keyword'));
    }


    // FORM TAMBAH
    public function create()
    {
        return view('admin.galeri.create');
    }


    // SIMPAN DATA
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|max:50',
            'keterangan' => 'required',
            'file' => 'required|file|mimes:jpg,jpeg,png,mp4,mov,avi|max:20480',
            'kategori' => 'required|in:Foto,Video',
            'tanggal' => 'required|date',
        ]);

        $namaFile = null;

        if ($request->hasFile('file')) {

            $file = $request->file('file');

            $namaFile = time() . '_' . $file->getClientOriginalName();

            $file->move(
                public_path('uploads/galeri'),
                $namaFile
            );
        }

        Galeri::create([
            'judul' => $request->judul,
            'keterangan' => $request->keterangan,
            'file' => $namaFile,
            'kategori' => $request->kategori,
            'tanggal' => $request->tanggal,
        ]);

        return redirect()
            ->route('admin.galeri.index')
            ->with('success', 'Data galeri berhasil ditambahkan.');
    }


    // FORM EDIT
    public function edit($id)
    {
        $galeri = Galeri::findOrFail($id);

        return view('admin.galeri.edit', compact('galeri'));
    }


    // UPDATE DATA
    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|max:50',
            'keterangan' => 'required',
            'file' => 'nullable|file|mimes:jpg,jpeg,png,mp4,mov,avi|max:20480',
            'kategori' => 'required|in:Foto,Video',
            'tanggal' => 'required|date',
        ]);

        $galeri = Galeri::findOrFail($id);

        $namaFile = $galeri->file;

        // Jika upload file baru
        if ($request->hasFile('file')) {

            // Hapus file lama
            if (
                $galeri->file &&
                file_exists(public_path('uploads/galeri/' . $galeri->file))
            ) {
                unlink(public_path('uploads/galeri/' . $galeri->file));
            }

            $file = $request->file('file');

            $namaFile = time() . '_' . $file->getClientOriginalName();

            $file->move(
                public_path('uploads/galeri'),
                $namaFile
            );
        }

        $galeri->update([
            'judul' => $request->judul,
            'keterangan' => $request->keterangan,
            'file' => $namaFile,
            'kategori' => $request->kategori,
            'tanggal' => $request->tanggal,
        ]);

        return redirect()
            ->route('admin.galeri.index')
            ->with('success', 'Data galeri berhasil diperbarui.');
    }


    // HAPUS DATA
    public function destroy($id)
    {
        $galeri = Galeri::findOrFail($id);

        // Hapus file
        if (
            $galeri->file &&
            file_exists(public_path('uploads/galeri/' . $galeri->file))
        ) {
            unlink(public_path('uploads/galeri/' . $galeri->file));
        }

        $galeri->delete();

        return redirect()
            ->route('admin.galeri.index')
            ->with('success', 'Data galeri berhasil dihapus.');
    }
}
