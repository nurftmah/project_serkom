<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    public function index()
    {
        $beritas = Berita::with('user')
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('admin.berita.index', compact('beritas'));
    }

    public function create()
    {
        return view('admin.berita.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:50',
            'slug' => 'required|string|max:100|unique:beritas,slug',
            'isi' => 'required|string',
            'tanggal' => 'required|date',
            'gambar' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'status' => 'required|in:Publish,Draft',
        ],[
            'judul.required' => 'Judul berita wajib diisi.',
            'judul.max' => 'Judul berita maksimal 50 karakter.',
            'slug.required' => 'Slug berita wajib diisi.',
            'slug.max' => 'Slug maksimal 100 karakter.',
            'slug.unique' => 'Slug tersebut sudah digunakan.',
            'isi.required' => 'Isi berita wajib diisi.',
            'tanggal.required' => 'Tanggal berita wajib diisi.',
            'tanggal.date' => 'Format tanggal tidak valid.',
            'gambar.required' => 'Gambar berita wajib diunggah.',
            'gambar.image' => 'File yang diunggah harus berupa gambar.',
            'gambar.mimes' => 'Gambar harus berformat JPG, JPEG, atau PNG.',
            'gambar.max' => 'Ukuran gambar maksimal 2 MB.',
            'status.required' => 'Status berita wajib dipilih.',
            'status.in' => 'Status berita harus Publish atau Draft.',
        ]);

        $namaGambar = basename(
            $request->file('gambar')->store('berita', 'public')
        );

        Berita::create([
            'judul' => $request->judul,
            'slug' => Str::slug($request->slug),
            'isi' => $request->isi,
            'tanggal' => $request->tanggal,
            'gambar' => $namaGambar,
            'status' => $request->status,
            'id_user' => Auth::id(),
        ]);

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil ditambahkan.');
    }

    private function bolehMengelola($berita)
    {
        return Auth::user()->role === 'Admin'
            || (int) $berita->id_user === (int) Auth::id();
    }

    public function edit($slug)
    {
        $berita = Berita::with('user')
            ->where('slug', $slug)
            ->first();

        if (!$berita) {
            return redirect()->route('admin.berita.index')
                ->with('error', 'Data berita tidak ditemukan.');
        }

        if (!$this->bolehMengelola($berita)) {
            return redirect()->route('admin.berita.index')
                ->with('error', 'Kamu tidak memiliki akses untuk mengedit berita ini.');
        }

        return view('admin.berita.edit', compact('berita'));
    }

    public function update(Request $request, $slug)
    {
        $berita = Berita::where('slug', $slug)->first();

        if (!$berita) {
            return redirect()->route('admin.berita.index')
                ->with('error', 'Data berita tidak ditemukan.');
        }

        if (!$this->bolehMengelola($berita)) {
            return redirect()->route('admin.berita.index')
                ->with('error', 'Kamu tidak memiliki akses untuk mengubah berita ini.');
        }

        $request->validate([
            'judul' => 'required|string|max:50',
            'slug' => 'required|string|max:100|unique:beritas,slug,'
                . $berita->id_berita . ',id_berita',
            'isi' => 'required|string',
            'tanggal' => 'required|date',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status' => 'required|in:Publish,Draft',
        ],[
            'judul.required' => 'Judul berita wajib diisi.',
            'judul.max' => 'Judul berita maksimal 50 karakter.',
            'slug.required' => 'Slug berita wajib diisi.',
            'slug.max' => 'Slug maksimal 100 karakter.',
            'slug.unique' => 'Slug tersebut sudah digunakan.',
            'isi.required' => 'Isi berita wajib diisi.',
            'tanggal.required' => 'Tanggal berita wajib diisi.',
            'tanggal.date' => 'Format tanggal tidak valid.',
            'gambar.required' => 'Gambar berita wajib diunggah.',
            'gambar.image' => 'File yang diunggah harus berupa gambar.',
            'gambar.mimes' => 'Gambar harus berformat JPG, JPEG, atau PNG.',
            'gambar.max' => 'Ukuran gambar maksimal 2 MB.',
            'status.required' => 'Status berita wajib dipilih.',
            'status.in' => 'Status berita harus Publish atau Draft.',
        ]);

        $namaGambar = $berita->gambar;

        if ($request->hasFile('gambar')) {
            $namaGambarBaru = basename(
                $request->file('gambar')->store('berita', 'public')
            );

            if ($berita->gambar) {
                Storage::disk('public')->delete(
                    'berita/' . $berita->gambar
                );
            }

            $namaGambar = $namaGambarBaru;
        }

        $berita->update([
            'judul' => $request->judul,
            'slug' => Str::slug($request->slug),
            'isi' => $request->isi,
            'tanggal' => $request->tanggal,
            'gambar' => $namaGambar,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy($slug)
    {
        $berita = Berita::where('slug', $slug)->first();

        if (!$berita) {
            return redirect()->route('admin.berita.index')
                ->with('error', 'Data berita tidak ditemukan.');
        }

        if (!$this->bolehMengelola($berita)) {
            return redirect()->route('admin.berita.index')
                ->with('error', 'Kamu tidak memiliki akses untuk menghapus berita ini.');
        }

        if ($berita->gambar) {
            Storage::disk('public')->delete(
                'berita/' . $berita->gambar
            );
        }

        $berita->delete();

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil dihapus.');
    }

    public function show($slug)
    {
        $berita = Berita::with('user')
            ->where('slug', $slug)
            ->where('status', 'Publish')
            ->firstOrFail();

        return view('landing.detail-berita', compact('berita'));
    }
}
