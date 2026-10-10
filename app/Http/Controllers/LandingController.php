<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Ektrakurikuler;
use App\Models\Galeri;
use App\Models\Guru;
use App\Models\Pengumuman;
use App\Models\Prestasi;
use App\Models\Profil;
use App\Models\Siswa;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;

class LandingController extends Controller
{
    public function index()
    {
        $profils = Profil::first();

        $beritas = Berita::where('status', 'Publish')
            ->latest('tanggal')
            ->take(3)
            ->get();

        $prestasis = Prestasi::latest('id_prestasi')
            ->take(3)
            ->get();

        $gurus = Guru::latest('id_guru')
            ->take(6)
            ->get();

        $ekstrakurikulers = Ektrakurikuler::latest('id_ekskul')
            ->take(3)
            ->get();

        $galeris = Galeri::latest('tanggal')
            ->take(6)
            ->get();

        $pengumumen = Pengumuman::latest('tanggal')
            ->take(3)
            ->get();

        $jumlahSiswa = Siswa::count();
        $jumlahGuru = Guru::count();
        $jumlahEkstrakurikuler = Ektrakurikuler::count();
        $jumlahPrestasi = Prestasi::count();

        return view('landing.index', compact(
            'beritas',
            'gurus',
            'profils',
            'prestasis',
            'galeris',
            'ekstrakurikulers',
            'pengumumen',
            'jumlahSiswa',
            'jumlahGuru',
            'jumlahEkstrakurikuler',
            'jumlahPrestasi'
        ));
    }

    public function berita()
    {
        $beritas = Berita::where('status', 'Publish')
            ->latest('tanggal')
            ->get();

        return view('landing.berita', compact('beritas'));
    }

   public function detailBerita($slug)
    {
        $berita = Berita::where('slug', $slug)
            ->where('status', 'Publish')
            ->firstOrFail();

        return view('landing.detail-berita', compact('berita'));
    }

    public function guru()
    {
        $gurus = Guru::orderBy('nama_guru', 'asc')->get();

        return view('landing.guru', compact('gurus'));
    }

    public function detailGuru($id)
    {
        try {
            $idGuru = Crypt::decryptString($id);

            $guru = Guru::where('id_guru', $idGuru)->first();

            if (!$guru) {
                return redirect()
                    ->route('landing.guru')
                    ->with('error', 'Data guru tidak ditemukan.');
            }

            return view('landing.detail-guru', compact('guru'));

        } catch (DecryptException $e) {
            return redirect()
                ->route('landing.guru')
                ->with('error', 'Data guru tidak ditemukan.');
        }
    }

    public function prestasi()
    {
        $prestasis = Prestasi::latest('id_prestasi')->get();

        return view('landing.prestasi', compact('prestasis'));
    }

    public function detailPrestasi($slug)
    {
        // $prestasi = Prestasi::where('id_prestasi', $id)->firstOrFail();
        $prestasi = Prestasi::where('slug', $slug)->firstOrFail();


        return view('landing.detail-prestasi', compact('prestasi'));
    }

    public function ekstrakurikuler()
    {
        $ekstrakurikulers = Ektrakurikuler::latest('id_ekskul')->get();

        return view('landing.ekstrakurikuler', compact('ekstrakurikulers'));
    }

    public function detailEkskul($slug)
    {
        $ekstrakurikulers = Ektrakurikuler::where('slug', $slug)->first();

        if (!$ekstrakurikulers) {
            return redirect()
                ->route('landing.ekstrakurikuler')
                ->with('error', 'Data ekstrakurikuler tidak ditemukan.');
        }

        return view('landing.detail-ekstrakurikuler', compact('ekstrakurikulers'));
    }

    public function galeri()
    {
       $galeris = Galeri::latest('tanggal')
        ->orderBy('id_galeri', 'desc')
        ->get();

        return view('landing.galeri', compact('galeris'));
    }

     public function detailGaleri($id)
    {
        try {
            $idgaleri = Crypt::decryptString($id);

            $galeris = Galeri::where('id_galeri', $idgaleri)->first();

            if (!$galeris) {
                return redirect()
                    ->route('landing.galeri')
                    ->with('error', 'Data galeri tidak ditemukan.');
            }

            return view('landing.detail-galeri', compact('galeris'));

        } catch (DecryptException $e) {
            return redirect()
                ->route('landing.galeri')
                ->with('error', 'Data galeri tidak ditemukan.');
        }
    }

    public function pengumuman()
    {
        $pengumumen = Pengumuman::latest('tanggal')->get();

        return view('landing.pengumuman', compact('pengumumen'));
    }

    public function detailPengumuman($id)
    {
        try {
            $id_pengumuman = Crypt::decryptString($id);

            $pengumuman = Pengumuman::where('id_pengumuman', $id_pengumuman)->first();

            if (!$pengumuman) {
                return redirect()
                    ->route('landing.pengumuman')
                    ->with('error', 'Data pengumuman tidak ditemukan.');
            }

            return view('landing.detail-pengumuman', compact('pengumuman'));

        } catch (DecryptException $e) {
            return redirect()
                ->route('landing.pengumuman')
                ->with('error', 'Data pengumuman tidak ditemukan.');
        }
    }

    public function tentang()
    {
        $profils = Profil::first();

        return view('landing.tentang', compact('profils'));
    }

}
