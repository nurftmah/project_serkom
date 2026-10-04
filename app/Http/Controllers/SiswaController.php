<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class SiswaController extends Controller
{

    public function index(Request $request)
    {
        $jenisKelamin = $request->jenis_kelamin;

        $siswas = Siswa::query()

            ->when($jenisKelamin, function ($query) use ($jenisKelamin) {
                $query->where('jenis_kelamin', $jenisKelamin);
            })

            ->orderBy('nama_siswa', 'asc')
            ->get();

        return view('admin.siswa.index', [
            'siswas' => $siswas,
            'jenisKelamin' => $jenisKelamin
        ]);
    }


    public function create()
    {
        return view('admin.siswa.create');
    }



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


    public function edit($id)
    {
        try {

            // Decrypt ID
            $id = Crypt::decryptString($id);

            // Cari data siswa
            $siswa = Siswa::find($id);

            // Jika data tidak ditemukan
            if (!$siswa) {
                return redirect()
                    ->route('admin.siswa.index')
                    ->with('error', 'Data siswa tidak ditemukan.');
            }

            return view('admin.siswa.edit', compact('siswa'));

        } catch (DecryptException $e) {

            // Jika ID URL rusak / diubah / dihapus
            return redirect()
                ->route('admin.siswa.index')
                ->with('error', 'Data siswa tidak ditemukan.');
        }
    }


    
    public function update(Request $request, $id)
    {
        try {

            // Decrypt ID
            $id = Crypt::decryptString($id);

            // Cari data siswa
            $siswa = Siswa::find($id);

            // Jika data tidak ditemukan
            if (!$siswa) {
                return redirect()
                    ->route('admin.siswa.index')
                    ->with('error', 'Data siswa tidak ditemukan.');
            }

            // Validasi
            $request->validate([
                'nisn' => 'required|string|max:10',
                'nama_siswa' => 'required|string|max:40',
                'jenis_kelamin' => 'required|in:Laki-Laki,Perempuan',
                'tahun_masuk' => 'required|integer|min:2000|max:2100',
            ]);

            // Update data
            $siswa->update([
                'nisn' => $request->nisn,
                'nama_siswa' => $request->nama_siswa,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tahun_masuk' => $request->tahun_masuk,
            ]);

            return redirect()
                ->route('admin.siswa.index')
                ->with('success', 'Data siswa berhasil diperbarui.');

        } catch (DecryptException $e) {

            // Jika ID URL rusak
            return redirect()
                ->route('admin.siswa.index')
                ->with('error', 'Data siswa tidak ditemukan.');
        }
    }


  
    public function destroy($id)
    {
        try {

            // Decrypt ID
            $id = Crypt::decryptString($id);

            // Cari data siswa
            $siswa = Siswa::find($id);

            // Jika data tidak ditemukan
            if (!$siswa) {
                return redirect()
                    ->route('admin.siswa.index')
                    ->with('error', 'Data siswa tidak ditemukan.');
            }

            // Hapus data
            $siswa->delete();

            return redirect()
                ->route('admin.siswa.index')
                ->with('success', 'Data siswa berhasil dihapus.');

        } catch (DecryptException $e) {

            // Jika ID URL rusak / diubah / dihapus
            return redirect()
                ->route('admin.siswa.index')
                ->with('error', 'Data siswa tidak ditemukan.');
        }
    }
}