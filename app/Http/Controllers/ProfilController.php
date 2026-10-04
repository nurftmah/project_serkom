<?php

namespace App\Http\Controllers;

use App\Models\Profil;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    public function index()
    {
        $profil = Profil::first();

        return view('admin.profil.index', compact('profil'));
    }

    public function edit()
    {
        $profil = Profil::first();

        if (!$profil) {
            return redirect()
                ->route('admin.profil.index')
                ->with('error', 'Data profil sekolah belum tersedia.');
        }

        return view('admin.profil.edit', compact('profil'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama_sekolah' => 'required',
            'kepala_sekolah' => 'required',
            'npsn' => 'required',
            'alamat' => 'required',
            'kontak' => 'required',
            'visi' => 'required',
            'misi' => 'required',
            'tahun_berdiri' => 'required',
            'deskripsi' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $profil = Profil::first();

        if (!$profil) {
            $profil = new Profil();
        }

        $profil->nama_sekolah = $request->nama_sekolah;
        $profil->kepala_sekolah = $request->kepala_sekolah;
        $profil->npsn = $request->npsn;
        $profil->alamat = $request->alamat;
        $profil->kontak = $request->kontak;
        $profil->visi = $request->visi;
        $profil->misi = $request->misi;
        $profil->tahun_berdiri = $request->tahun_berdiri;
        $profil->deskripsi = $request->deskripsi;

        $folder = public_path('uploads/profil');

        if (!file_exists($folder)) {
            mkdir($folder, 0777, true);
        }

        if ($request->hasFile('foto')) {
            if ($profil->foto && file_exists($folder . '/' . $profil->foto)) {
                unlink($folder . '/' . $profil->foto);
            }

            $foto = $request->file('foto');
            $namaFoto = time() . '_foto.' . $foto->extension();
            $foto->move($folder, $namaFoto);

            $profil->foto = $namaFoto;
        }

        if ($request->hasFile('logo')) {
            if ($profil->logo && file_exists($folder . '/' . $profil->logo)) {
                unlink($folder . '/' . $profil->logo);
            }

            $logo = $request->file('logo');
            $namaLogo = time() . '_logo.' . $logo->extension();
            $logo->move($folder, $namaLogo);

            $profil->logo = $namaLogo;
        }

        $profil->save();

        return redirect()
            ->route('admin.profil.index')
            ->with('success', 'Profil sekolah berhasil diperbarui.');
    }
}
