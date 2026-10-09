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
        $kelas = $request->kelas;
        $jenisKelamin = $request->jenis_kelamin;

        $siswas = Siswa::query()
            ->when($kelas, function ($query) use ($kelas) {
                $query->where('kelas', $kelas);
            })
            ->when($jenisKelamin, function ($query) use ($jenisKelamin) {
                $query->where('jenis_kelamin', $jenisKelamin);
            })
            ->orderBy('nama_siswa', 'asc')
            ->get();

        return view('admin.siswa.index', compact('siswas', 'kelas', 'jenisKelamin'));
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
            'kelas' => 'required|in:VII A,VII B,VIII A,VIII B,IX A,IX B',
            'tahun_masuk' => 'required|integer|min:2000|max:2100',
        ]);

        Siswa::create([
            'nisn' => $request->nisn,
            'nama_siswa' => $request->nama_siswa,
            'jenis_kelamin' => $request->jenis_kelamin,
            'kelas' => $request->kelas,
            'tahun_masuk' => $request->tahun_masuk,
        ]);

        return redirect()
            ->route('admin.siswa.index')
            ->with('success', 'Data siswa berhasil ditambahkan.');
    }

    public function edit($id)
    {
        try {
            $id = Crypt::decryptString($id);
            $siswa = Siswa::find($id);

            if (!$siswa) {
                return redirect()->route('admin.siswa.index')
                    ->with('error', 'Data siswa tidak ditemukan.');
            }

            return view('admin.siswa.edit', compact('siswa'));
        } catch (DecryptException $e) {
            return redirect()->route('admin.siswa.index')
                ->with('error', 'Data siswa tidak ditemukan.');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $id = Crypt::decryptString($id);
            $siswa = Siswa::find($id);

            if (!$siswa) {
                return redirect()->route('admin.siswa.index')
                    ->with('error', 'Data siswa tidak ditemukan.');
            }

            $request->validate([
                'nisn' => 'required|string|max:10',
                'nama_siswa' => 'required|string|max:40',
                'jenis_kelamin' => 'required|in:Laki-Laki,Perempuan',
                'kelas' => 'required|in:VII A,VII B,VIII A,VIII B,IX A,IX B',
                'tahun_masuk' => 'required|integer|min:2000|max:2100',
            ]);

            $siswa->update([
                'nisn' => $request->nisn,
                'nama_siswa' => $request->nama_siswa,
                'jenis_kelamin' => $request->jenis_kelamin,
                'kelas' => $request->kelas,
                'tahun_masuk' => $request->tahun_masuk,
            ]);

            return redirect()->route('admin.siswa.index')
                ->with('success', 'Data siswa berhasil diperbarui.');
        } catch (DecryptException $e) {
            return redirect()->route('admin.siswa.index')
                ->with('error', 'Data siswa tidak ditemukan.');
        }
    }

    public function destroy($id)
    {
        try {
            $id = Crypt::decryptString($id);
            $siswa = Siswa::find($id);

            if (!$siswa) {
                return redirect()->route('admin.siswa.index')
                    ->with('error', 'Data siswa tidak ditemukan.');
            }

            $siswa->delete();

            return redirect()->route('admin.siswa.index')
                ->with('success', 'Data siswa berhasil dihapus.');
        } catch (DecryptException $e) {
            return redirect()->route('admin.siswa.index')
                ->with('error', 'Data siswa tidak ditemukan.');
        }
    }
}
