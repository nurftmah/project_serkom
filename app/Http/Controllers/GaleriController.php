<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;

class GaleriController extends Controller
{
    public function index()
    {
        $galeris = Galeri::orderBy('tanggal', 'desc')
            ->get();

        return view(
            'admin.galeri.index',
            compact('galeris')
        );
    }

    public function create()
    {
        return view('admin.galeri.create');
    }

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

            $folder = public_path('uploads/galeri');

            if (!file_exists($folder)) {
                mkdir($folder, 0777, true);
            }

            $file->move($folder, $namaFile);
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

    public function edit($id)
    {
        try {
            $id = Crypt::decryptString($id);

            $galeri = Galeri::find($id);

            if (!$galeri) {
                return redirect()
                    ->route('admin.galeri.index')
                    ->with('error', 'Data galeri tidak ditemukan.');
            }

            return view('admin.galeri.edit', compact('galeri'));

        } catch (DecryptException $e) {
            return redirect()
                ->route('admin.galeri.index')
                ->with('error', 'Data galeri tidak ditemukan.');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $id = Crypt::decryptString($id);

            $galeri = Galeri::find($id);

            if (!$galeri) {
                return redirect()
                    ->route('admin.galeri.index')
                    ->with('error', 'Data galeri tidak ditemukan.');
            }

            $request->validate([
                'judul' => 'required|max:50',
                'keterangan' => 'required',
                'file' => 'nullable|file|mimes:jpg,jpeg,png,mp4,mov,avi|max:20480',
                'kategori' => 'required|in:Foto,Video',
                'tanggal' => 'required|date',
            ]);

            $namaFile = $galeri->file;

            if ($request->hasFile('file')) {
                if (
                    $galeri->file &&
                    file_exists(
                        public_path('uploads/galeri/' . $galeri->file)
                    )
                ) {
                    unlink(
                        public_path('uploads/galeri/' . $galeri->file)
                    );
                }

                $file = $request->file('file');

                $namaFile = time() . '_' . $file->getClientOriginalName();

                $folder = public_path('uploads/galeri');

                if (!file_exists($folder)) {
                    mkdir($folder, 0777, true);
                }

                $file->move($folder, $namaFile);
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

        } catch (DecryptException $e) {
            return redirect()
                ->route('admin.galeri.index')
                ->with('error', 'Data galeri tidak ditemukan.');
        }
    }

    public function destroy($id)
    {
        try {
            $id = Crypt::decryptString($id);

            $galeri = Galeri::find($id);

            if (!$galeri) {
                return redirect()
                    ->route('admin.galeri.index')
                    ->with('error', 'Data galeri tidak ditemukan.');
            }

            if (
                $galeri->file &&
                file_exists(
                    public_path('uploads/galeri/' . $galeri->file)
                )
            ) {
                unlink(
                    public_path('uploads/galeri/' . $galeri->file)
                );
            }

            $galeri->delete();

            return redirect()
                ->route('admin.galeri.index')
                ->with('success', 'Data galeri berhasil dihapus.');

        } catch (DecryptException $e) {
            return redirect()
                ->route('admin.galeri.index')
                ->with('error', 'Data galeri tidak ditemukan.');
        }
    }
}