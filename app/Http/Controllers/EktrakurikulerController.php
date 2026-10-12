<?php

namespace App\Http\Controllers;

use App\Models\Ektrakurikuler;
use App\Models\Guru;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EktrakurikulerController extends Controller
{
    public function index(Request $request)
    {
        $ekstrakurikulers = Ektrakurikuler::with('guru')
            ->orderBy('nama_ekskul', 'asc')
            ->get();

        return view('admin.ekstrakurikuler.index', compact('ekstrakurikulers'));
    }

    public function create()
    {
        $gurus = Guru::orderBy('nama_guru', 'asc')->get();

        return view('admin.ekstrakurikuler.create', compact('gurus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_ekskul' => 'required|string|max:40',
            'id_guru' => 'required|exists:gurus,id_guru',
            'jadwal_latihan' => 'required|string|max:40',
            'deskripsi' => 'required|string',
            'gambar' => 'required|image|mimes:jpg,jpeg,png,jfif|max:2048',
        ],[
            'nama_ekskul.required' => 'Nama ekstrakurikuler wajib diisi.',
            'nama_ekskul.max' => 'Nama ekstrakurikuler maksimal 40 karakter.',
            'id_guru.required' => 'Pembina ekstrakurikuler wajib dipilih.',
            'id_guru.exists' => 'Pembina yang dipilih tidak ditemukan.',
            'jadwal_latihan.required' => 'Jadwal latihan wajib diisi.',
            'jadwal_latihan.max' => 'Jadwal latihan maksimal 40 karakter.',
            'deskripsi.required' => 'Deskripsi ekstrakurikuler wajib diisi.',
            'gambar.required' => 'Gambar ekstrakurikuler wajib diunggah.',
            'gambar.image' => 'File yang diunggah harus berupa gambar.',
            'gambar.mimes' => 'Gambar harus berformat JPG, JPEG, PNG, atau JFIF.',
            'gambar.max' => 'Ukuran gambar maksimal 2 MB.',
        ]);

        $namaGambar = null;

        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('ekstrakurikuler', 'public');
            $namaGambar = basename($path);
        }

        Ektrakurikuler::create([
            'nama_ekskul' => $request->nama_ekskul,
            'slug' => Str::slug($request->nama_ekskul),
            'id_guru' => $request->id_guru,
            'jadwal_latihan' => $request->jadwal_latihan,
            'deskripsi' => $request->deskripsi,
            'gambar' => $namaGambar,
        ]);

        return redirect()
            ->route('admin.ekstrakurikuler.index')
            ->with('success', 'Data ekstrakurikuler berhasil ditambahkan.');
    }

    public function edit($id)
    {
        try {
            $id = Crypt::decryptString($id);
            $ekstrakurikuler = Ektrakurikuler::find($id);

            if (!$ekstrakurikuler) {
                return redirect()
                    ->route('admin.ekstrakurikuler.index')
                    ->with('error', 'Data ekstrakurikuler tidak ditemukan.');
            }

            $gurus = Guru::orderBy('nama_guru', 'asc')->get();

            return view('admin.ekstrakurikuler.edit', compact('ekstrakurikuler', 'gurus'));
        } catch (DecryptException $e) {
            return redirect()
                ->route('admin.ekstrakurikuler.index')
                ->with('error', 'Data ekstrakurikuler tidak ditemukan.');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $id = Crypt::decryptString($id);
            $ekstrakurikuler = Ektrakurikuler::find($id);

            if (!$ekstrakurikuler) {
                return redirect()
                    ->route('admin.ekstrakurikuler.index')
                    ->with('error', 'Data ekstrakurikuler tidak ditemukan.');
            }

            $request->validate([
                'nama_ekskul' => 'required|string|max:40',
                'id_guru' => 'required|exists:gurus,id_guru',
                'jadwal_latihan' => 'required|string|max:40',
                'deskripsi' => 'required|string',
                'gambar' => 'nullable|image|mimes:jpg,jpeg,png,jfif|max:2048',
            ],[
                'nama_ekskul.required' => 'Nama ekstrakurikuler wajib diisi.',
                'nama_ekskul.max' => 'Nama ekstrakurikuler maksimal 40 karakter.',
                'id_guru.required' => 'Pembina ekstrakurikuler wajib dipilih.',
                'id_guru.exists' => 'Pembina yang dipilih tidak ditemukan.',
                'jadwal_latihan.required' => 'Jadwal latihan wajib diisi.',
                'jadwal_latihan.max' => 'Jadwal latihan maksimal 40 karakter.',
                'deskripsi.required' => 'Deskripsi ekstrakurikuler wajib diisi.',
                'gambar.required' => 'Gambar ekstrakurikuler wajib diunggah.',
                'gambar.image' => 'File yang diunggah harus berupa gambar.',
                'gambar.mimes' => 'Gambar harus berformat JPG, JPEG, PNG, atau JFIF.',
                'gambar.max' => 'Ukuran gambar maksimal 2 MB.',
            ]);

            $namaGambar = $ekstrakurikuler->gambar;

            if ($request->hasFile('gambar')) {
                $path = $request->file('gambar')->store('ekstrakurikuler', 'public');
                $gambarBaru = basename($path);

                if ($namaGambar) {
                    Storage::disk('public')->delete('ekstrakurikuler/' . $namaGambar);
                }

                $namaGambar = $gambarBaru;
            }

            $ekstrakurikuler->update([
                'nama_ekskul' => $request->nama_ekskul,
                'slug' => Str::slug($request->nama_ekskul),
                'id_guru' => $request->id_guru,
                'jadwal_latihan' => $request->jadwal_latihan,
                'deskripsi' => $request->deskripsi,
                'gambar' => $namaGambar,
            ]);

            return redirect()
                ->route('admin.ekstrakurikuler.index')
                ->with('success', 'Data ekstrakurikuler berhasil diperbarui.');
        } catch (DecryptException $e) {
            return redirect()
                ->route('admin.ekstrakurikuler.index')
                ->with('error', 'Data ekstrakurikuler tidak ditemukan.');
        }
    }

    public function destroy($id)
    {
        try {
            $id = Crypt::decryptString($id);
            $ekstrakurikuler = Ektrakurikuler::find($id);

            if (!$ekstrakurikuler) {
                return redirect()
                    ->route('admin.ekstrakurikuler.index')
                    ->with('error', 'Data ekstrakurikuler tidak ditemukan.');
            }

            if ($ekstrakurikuler->gambar) {
                Storage::disk('public')->delete('ekstrakurikuler/' . $ekstrakurikuler->gambar);
            }

            $ekstrakurikuler->delete();

            return redirect()
                ->route('admin.ekstrakurikuler.index')
                ->with('success', 'Data ekstrakurikuler berhasil dihapus.');
        } catch (DecryptException $e) {
            return redirect()
                ->route('admin.ekstrakurikuler.index')
                ->with('error', 'Data ekstrakurikuler tidak ditemukan.');
        }
    }
}
