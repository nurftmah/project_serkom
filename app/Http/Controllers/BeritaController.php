<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BeritaController extends Controller
{
    // =====================================================
    // MENAMPILKAN DATA BERITA
    // =====================================================
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $beritas = Berita::when($keyword, function ($query) use ($keyword) {

            $query->where('judul', 'like', '%' . $keyword . '%')
                  ->orWhere('isi', 'like', '%' . $keyword . '%');

        })
        ->orderBy('tanggal', 'desc')
        ->get();

        return view(
            'admin.berita.index',
            compact('beritas', 'keyword')
        );
    }


    // =====================================================
    // FORM TAMBAH BERITA
    // =====================================================
    public function create()
    {
        return view('admin.berita.create');
    }


    // =====================================================
    // SIMPAN BERITA
    // =====================================================
    public function store(Request $request)
    {
        $request->validate([
            'judul'   => 'required|max:50',
            'isi'     => 'required',
            'tanggal' => 'required|date',
            'gambar'  => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'status'  => 'required|in:Publish,Draft',
        ]);

        // ---------------------------------------------
        // UPLOAD GAMBAR
        // ---------------------------------------------

        $namaGambar = null;

        if ($request->hasFile('gambar')) {

            $file = $request->file('gambar');

            $namaGambar = time() . '_' . $file->getClientOriginalName();

            // Pastikan folder tersedia
            $folder = public_path('uploads/berita');

            if (!file_exists($folder)) {
                mkdir($folder, 0777, true);
            }

            $file->move(
                $folder,
                $namaGambar
            );
        }


        // ---------------------------------------------
        // SIMPAN BERITA
        // ---------------------------------------------

        Berita::create([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'tanggal' => $request->tanggal,
            'gambar' => $namaGambar,
            'status' => $request->status,
            'id_user' => Auth::id(),
        ]);


        return redirect()
            ->route('admin.berita.index')
            ->with('success', 'Berita berhasil ditambahkan.');
    }


    // =====================================================
    // FORM EDIT BERITA
    // =====================================================
    public function edit($id)
    {
        $berita = Berita::findOrFail($id);

        return view(
            'admin.berita.edit',
            compact('berita')
        );
    }


    // =====================================================
    // UPDATE BERITA
    // =====================================================
    public function update(Request $request, $id)
    {
        $request->validate([
            'judul'   => 'required|max:50',
            'isi'     => 'required',
            'tanggal' => 'required|date',
            'gambar'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status'  => 'required|in:Publish,Draft',
        ]);


        $berita = Berita::findOrFail($id);

        // Simpan gambar lama
        $namaGambar = $berita->gambar;


        // ---------------------------------------------
        // JIKA ADA GAMBAR BARU
        // ---------------------------------------------

        if ($request->hasFile('gambar')) {

            // Hapus gambar lama
            if (
                $berita->gambar &&
                file_exists(
                    public_path('uploads/berita/' . $berita->gambar)
                )
            ) {
                unlink(
                    public_path('uploads/berita/' . $berita->gambar)
                );
            }


            $file = $request->file('gambar');

            $namaGambar = time() . '_' . $file->getClientOriginalName();


            // Pastikan folder tersedia
            $folder = public_path('uploads/berita');

            if (!file_exists($folder)) {
                mkdir($folder, 0777, true);
            }


            $file->move(
                $folder,
                $namaGambar
            );
        }


        // ---------------------------------------------
        // UPDATE DATA
        // ---------------------------------------------

        $berita->update([
            'judul'   => $request->judul,
            'isi'     => $request->isi,
            'tanggal' => $request->tanggal,
            'gambar'  => $namaGambar,
            'status'  => $request->status,
            'id_user' => Auth::id(),
        ]);


        return redirect()
            ->route('admin.berita.index')
            ->with('success', 'Berita berhasil diperbarui.');
    }


    // =====================================================
    // HAPUS BERITA
    // =====================================================
    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);


        // Hapus gambar
        if (
            $berita->gambar &&
            file_exists(
                public_path('uploads/berita/' . $berita->gambar)
            )
        ) {
            unlink(
                public_path('uploads/berita/' . $berita->gambar)
            );
        }


        // Hapus data berita
        $berita->delete();


        return redirect()
            ->route('admin.berita.index')
            ->with('success', 'Berita berhasil dihapus.');
    }
}
