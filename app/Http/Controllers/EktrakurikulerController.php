<?php

namespace App\Http\Controllers;

// use App\Models\Ekstrakurikuler;
use App\Models\Ektrakurikuler;
use Illuminate\Http\Request;

class EktrakurikulerController extends Controller
{
    // Menampilkan data ekstrakurikuler
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $ekstrakurikulers = Ektrakurikuler::query()
            ->when($keyword, function ($query) use ($keyword) {

                $query->where('nama_ekskul', 'like', '%' . $keyword . '%')
                      ->orWhere('pembina', 'like', '%' . $keyword . '%');

            })
            ->orderBy('nama_ekskul', 'asc')
            ->get();

        return view('admin.ekstrakurikuler.index', compact(
            'ekstrakurikulers',
            'keyword'
        ));
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
        $ekstrakurikuler = Ektrakurikuler::findOrFail($id);

        return view(
            'admin.ekstrakurikuler.edit',
            compact('ekstrakurikuler')
        );
    }


    // Update data
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_ekskul' => 'required|string|max:40',
            'pembina' => 'required|string|max:40',
            'jadwal_latihan' => 'required|string|max:40',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $ekstrakurikuler = Ektrakurikuler::findOrFail($id);

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
    }


    // Hapus data
    public function destroy($id)
    {
        $ekstrakurikuler = Ektrakurikuler::findOrFail($id);

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

        $ekstrakurikuler->delete();

        return redirect()
            ->route('admin.ekstrakurikuler.index')
            ->with('success', 'Data ekstrakurikuler berhasil dihapus.');
    }
}
