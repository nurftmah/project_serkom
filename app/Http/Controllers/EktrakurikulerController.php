<?php

namespace App\Http\Controllers;

use App\Models\Ektrakurikuler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class EktrakurikulerController extends Controller
{
    // Menampilkan data ekstrakurikuler
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $ekstrakurikulers = Ektrakurikuler::query()
            ->when($keyword, function ($query) use ($keyword) {

                $query->where(function ($q) use ($keyword) {

                    $q->where('nama_ekskul', 'like', '%' . $keyword . '%')
                      ->orWhere('pembina', 'like', '%' . $keyword . '%');

                });

            })
            ->orderBy('nama_ekskul', 'asc')
            ->get();

        return view('admin.ekstrakurikuler.index', [
            'ekstrakurikulers' => $ekstrakurikulers,
            'keyword' => $keyword
        ]);
    }


    // Form tambah data
    public function create()
    {
        return view('admin.ekstrakurikuler.create');
    }


    // Simpan data
    public function store(Request $request)
    {
        $request->validate([
            'nama_ekskul' => 'required|string|max:40',
            'pembina' => 'required|string|max:40',
            'jadwal_latihan' => 'required|string|max:40',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $namaGambar = null;

        if ($request->hasFile('gambar')) {

            $file = $request->file('gambar');

            $namaGambar = time() . '_' . $file->getClientOriginalName();

            $file->move(
                public_path('uploads/ekstrakurikuler'),
                $namaGambar
            );
        }

        Ektrakurikuler::create([
            'nama_ekskul' => $request->nama_ekskul,
            'pembina' => $request->pembina,
            'jadwal_latihan' => $request->jadwal_latihan,
            'deskripsi' => $request->deskripsi,
            'gambar' => $namaGambar,
        ]);

        return redirect()
            ->route('admin.ekstrakurikuler.index')
            ->with('success', 'Data ekstrakurikuler berhasil ditambahkan.');
    }


    // Form edit
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

            return view(
                'admin.ekstrakurikuler.edit',
                compact('ekstrakurikuler')
            );

        } catch (DecryptException $e) {

            return redirect()
                ->route('admin.ekstrakurikuler.index')
                ->with('error', 'Data ekstrakurikuler tidak ditemukan.');
        }
    }


    // Update data
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
                'pembina' => 'required|string|max:40',
                'jadwal_latihan' => 'required|string|max:40',
                'deskripsi' => 'required|string',
                'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            ]);

            $namaGambar = $ekstrakurikuler->gambar;


            // Jika upload gambar baru
            if ($request->hasFile('gambar')) {

                // Hapus gambar lama
                if (
                    $ekstrakurikuler->gambar &&
                    file_exists(
                        public_path(
                            'uploads/ekstrakurikuler/' .
                            $ekstrakurikuler->gambar
                        )
                    )
                ) {
                    unlink(
                        public_path(
                            'uploads/ekstrakurikuler/' .
                            $ekstrakurikuler->gambar
                        )
                    );
                }


                // Simpan gambar baru
                $file = $request->file('gambar');

                $namaGambar = time() . '_' . $file->getClientOriginalName();

                $file->move(
                    public_path('uploads/ekstrakurikuler'),
                    $namaGambar
                );
            }


            $ekstrakurikuler->update([
                'nama_ekskul' => $request->nama_ekskul,
                'pembina' => $request->pembina,
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


    // Hapus data
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


            // Hapus gambar
            if (
                $ekstrakurikuler->gambar &&
                file_exists(
                    public_path(
                        'uploads/ekstrakurikuler/' .
                        $ekstrakurikuler->gambar
                    )
                )
            ) {
                unlink(
                    public_path(
                        'uploads/ekstrakurikuler/' .
                        $ekstrakurikuler->gambar
                    )
                );
            }


            // Hapus data
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