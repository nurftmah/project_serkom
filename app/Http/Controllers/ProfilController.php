<?php
namespace App\Http\Controllers;
use App\Models\Profil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
            return redirect()->route('admin.profil.index')->with('error', 'Data profil sekolah belum tersedia.');
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
        if ($request->hasFile('foto')) {
            if ($profil->foto) {
                Storage::disk('public')->delete('profil/' . $profil->foto);
            }
            $profil->foto = basename($request->file('foto')->store('profil', 'public'));
        }
        if ($request->hasFile('logo')) {
            if ($profil->logo) {
                Storage::disk('public')->delete('profil/' . $profil->logo);
            }
            $profil->logo = basename($request->file('logo')->store('profil', 'public'));
        }
        $profil->save();
        return redirect()->route('admin.profil.index')->with('success', 'Profil sekolah berhasil diperbarui.');
    }
}
