<?php

namespace App\Http\Controllers;

use App\Models\Profil;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    // Menampilkan profil sekolah
    public function index()
    {
        // Mengambil data pertama, atau otomatis membuat data kosong jika tabel masih kosong
        $profil = Profil::first() ?? new Profil();

        return view('admin.profil', compact('profil'));
    }

    // Menyimpan perubahan profil
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_sekolah'   => 'required',
            'kepala_sekolah' => 'required',
            'npsn'           => 'required',
            'alamat'         => 'required',
            'kontak'         => 'required',
            'visi_misi'      => 'required',
            'tahun_berdiri'  => 'required',
            'deskripsi'      => 'required',
            'foto'           => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'logo'           => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Jika $id bernilai 0 (karena data awal belum ada), gunakan firstOrNew atau buat instance baru
        if ($id == 0) {
            $profil = new Profil();
        } else {
            $profil = Profil::findOrFail($id);
        }

        // Data teks
        $profil->nama_sekolah   = $request->nama_sekolah;
        $profil->kepala_sekolah = $request->kepala_sekolah;
        $profil->npsn           = $request->npsn;
        $profil->alamat         = $request->alamat;
        $profil->kontak         = $request->kontak;
        $profil->visi_misi      = $request->visi_misi;
        $profil->tahun_berdiri  = $request->tahun_berdiri;
        $profil->deskripsi      = $request->deskripsi;

        // Upload foto kepala sekolah
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $namaFoto = time() . '_foto.' . $foto->extension();
            $foto->move(public_path('uploads/profil'), $namaFoto);
            $profil->foto = $namaFoto;
        }

        // Upload logo sekolah
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $namaLogo = time() . '_logo.' . $logo->extension();
            $logo->move(public_path('uploads/profil'), $namaLogo);
            $profil->logo = $namaLogo;
        }

        // Simpan ke database
        $profil->save();

        return redirect()
            ->route('admin.profil')
            ->with('success', 'Profil sekolah berhasil diperbarui.');
    }
}
