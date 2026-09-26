<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    // Menampilkan data siswa
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $siswas = Siswa::query()
            ->when($keyword, function ($query) use ($keyword) {
                $query->where('nisn', 'like', '%' . $keyword . '%')
                      ->orWhere('nama_siswa', 'like', '%' . $keyword . '%');
            })
            ->orderBy('nama_siswa', 'asc')
            ->get();

        return view('admin.siswa.index', [
            'siswas' => $siswas,
            'keyword' => $keyword
        ]);
    }


    // Menampilkan form tambah siswa
    public function create()
    {
        return view('admin.siswa.create');
    }


    // Menyimpan data siswa
    public function store(Request $request)
    {
        $request->validate([
            'nisn' => 'required|string|max:10',
            'nama_siswa' => 'required|string|max:40',
            'jenis_kelamin' => 'required|in:Laki-Laki,Perempuan',
            'tahun_masuk' => 'required|integer|min:2000|max:2100',
        ]);

        Siswa::create([
            'nisn' => $request->nisn,
            'nama_siswa' => $request->nama_siswa,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tahun_masuk' => $request->tahun_masuk,
        ]);

        return redirect()
            ->route('admin.siswa.index')
            ->with('success', 'Data siswa berhasil ditambahkan.');
    }


    // Menampilkan form edit siswa
    public function edit($id)
    {
        $siswa = Siswa::findOrFail($id);

        return view('admin.siswa.edit', compact('siswa'));
    }


    // Mengupdate data siswa
    public function update(Request $request, $id)
    {
        $request->validate([
            'nisn' => 'required|string|max:10',
            'nama_siswa' => 'required|string|max:40',
            'jenis_kelamin' => 'required|in:Laki-Laki,Perempuan',
            'tahun_masuk' => 'required|integer|min:2000|max:2100',
        ]);

        $siswa = Siswa::findOrFail($id);

        $siswa->update([
            'nisn' => $request->nisn,
            'nama_siswa' => $request->nama_siswa,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tahun_masuk' => $request->tahun_masuk,
        ]);

        return redirect()
            ->route('admin.siswa.index')
            ->with('success', 'Data siswa berhasil diperbarui.');
    }


    // Menghapus data siswa
    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);

        $siswa->delete();

        return redirect()
            ->route('admin.siswa.index')
            ->with('success', 'Data siswa berhasil dihapus.');
    }
}
