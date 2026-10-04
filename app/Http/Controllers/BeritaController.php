<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class BeritaController extends Controller
{
    public function index()
    {
        $beritas = Berita::orderBy('tanggal', 'desc')->get();

        return view('admin.berita.index', compact('beritas'));
    }

    public function create()
    {
        return view('admin.berita.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|max:50',
            'isi' => 'required',
            'tanggal' => 'required|date',
            'gambar' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'status' => 'required|in:Publish,Draft',
        ]);

        $namaGambar = null;

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $namaGambar = time() . '_' . $file->getClientOriginalName();

            $folder = public_path('uploads/berita');

            if (!file_exists($folder)) {
                mkdir($folder, 0777, true);
            }

            $file->move($folder, $namaGambar);
        }

        Berita::create([
            'judul' => $request->judul,
            'slug' => Str::slug($request->slug),
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

    public function edit($id)
    {
        try {
            $idBerita = Crypt::decryptString($id);

            $berita = Berita::where('id_berita', $idBerita)->first();

            if (!$berita) {
                return redirect()
                    ->route('admin.berita.index')
                    ->with('error', 'Data berita tidak ditemukan.');
            }

            return view('admin.berita.edit', compact('berita'));

        } catch (DecryptException $e) {
            return redirect()
                ->route('admin.berita.index')
                ->with('error', 'Data berita tidak ditemukan.');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $idBerita = Crypt::decryptString($id);

            $berita = Berita::where('id_berita', $idBerita)->first();

            if (!$berita) {
                return redirect()
                    ->route('admin.berita.index')
                    ->with('error', 'Data berita tidak ditemukan.');
            }

            $request->validate([
                'judul' => 'required|max:50',
                'slug' => 'required|max:100|unique:beritas,slug,' . $idBerita . ',id_berita',
                'isi' => 'required',
                'tanggal' => 'required|date',
                'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
                'status' => 'required|in:Publish,Draft',
            ]);

            $namaGambar = $berita->gambar;

            if ($request->hasFile('gambar')) {
                if (
                    $berita->gambar &&
                    file_exists(public_path('uploads/berita/' . $berita->gambar))
                ) {
                    unlink(public_path('uploads/berita/' . $berita->gambar));
                }

                $file = $request->file('gambar');
                $namaGambar = time() . '_' . $file->getClientOriginalName();

                $folder = public_path('uploads/berita');

                if (!file_exists($folder)) {
                    mkdir($folder, 0777, true);
                }

                $file->move($folder, $namaGambar);
            }

            $berita->update([
                'judul' => $request->judul,
                'slug' => Str::slug($request->slug),
                'isi' => $request->isi,
                'tanggal' => $request->tanggal,
                'gambar' => $namaGambar,
                'status' => $request->status,
                'id_user' => Auth::id(),
            ]);

            return redirect()
                ->route('admin.berita.index')
                ->with('success', 'Berita berhasil diperbarui.');

        } catch (DecryptException $e) {
            return redirect()
                ->route('admin.berita.index')
                ->with('error', 'Data berita tidak ditemukan.');
        }
    }

    public function destroy($id)
    {
        try {
            $idBerita = Crypt::decryptString($id);

            $berita = Berita::where('id_berita', $idBerita)->first();

            if (!$berita) {
                return redirect()
                    ->route('admin.berita.index')
                    ->with('error', 'Data berita tidak ditemukan.');
            }

            if (
                $berita->gambar &&
                file_exists(public_path('uploads/berita/' . $berita->gambar))
            ) {
                unlink(public_path('uploads/berita/' . $berita->gambar));
            }

            $berita->delete();

            return redirect()
                ->route('admin.berita.index')
                ->with('success', 'Berita berhasil dihapus.');

        } catch (DecryptException $e) {
            return redirect()
                ->route('admin.berita.index')
                ->with('error', 'Data berita tidak ditemukan.');
        }
    }

    public function show($slug)
    {
        $berita = Berita::where('slug', $slug)
            ->where('status', 'Publish')
            ->firstOrFail();

        return view('berita.show', compact('berita'));
    }
}
