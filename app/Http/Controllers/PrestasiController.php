<?php

namespace App\Http\Controllers;

use App\Models\Prestasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class PrestasiController extends Controller
{
    public function index()
    {
        $prestasis = Prestasi::orderBy('tahun_ajaran', 'desc')->get();

        return view('admin.prestasi.index', compact('prestasis'));
    }

    public function create()
    {
        return view('admin.prestasi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_prestasi' => 'required|max:40',
            'deskripsi' => 'required',
            'foto' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'tahun_ajaran' => 'required|integer',
        ]);

        $namaFoto = null;

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');

            $namaFoto = time() . '_' . $file->getClientOriginalName();

            $folder = public_path('uploads/prestasi');

            if (!file_exists($folder)) {
                mkdir($folder, 0777, true);
            }

            $file->move($folder, $namaFoto);
        }

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

    public function edit($id)
    {
        try {
            $id = Crypt::decryptString($id);

            $prestasi = Prestasi::find($id);

            if (!$prestasi) {
                return redirect()
                    ->route('admin.prestasi.index')
                    ->with('error', 'Data prestasi tidak ditemukan.');
            }

            return view('admin.prestasi.edit', compact('prestasi'));

        } catch (DecryptException $e) {
            return redirect()
                ->route('admin.prestasi.index')
                ->with('error', 'Data prestasi tidak ditemukan.');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $id = Crypt::decryptString($id);

            $prestasi = Prestasi::find($id);

            if (!$prestasi) {
                return redirect()
                    ->route('admin.prestasi.index')
                    ->with('error', 'Data prestasi tidak ditemukan.');
            }

            $request->validate([
                'nama_prestasi' => 'required|max:40',
                'deskripsi' => 'required',
                'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
                'tahun_ajaran' => 'required|integer',
            ]);

            $namaFoto = $prestasi->foto;

            if ($request->hasFile('foto')) {
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

                $folder = public_path('uploads/prestasi');

                if (!file_exists($folder)) {
                    mkdir($folder, 0777, true);
                }

                $file->move($folder, $namaFoto);
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

        } catch (DecryptException $e) {
            return redirect()
                ->route('admin.prestasi.index')
                ->with('error', 'Data prestasi tidak ditemukan.');
        }
    }

    public function destroy($id)
    {
        try {
            $id = Crypt::decryptString($id);

            $prestasi = Prestasi::find($id);

            if (!$prestasi) {
                return redirect()
                    ->route('admin.prestasi.index')
                    ->with('error', 'Data prestasi tidak ditemukan.');
            }

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

        } catch (DecryptException $e) {
            return redirect()
                ->route('admin.prestasi.index')
                ->with('error', 'Data prestasi tidak ditemukan.');
        }
    }
}