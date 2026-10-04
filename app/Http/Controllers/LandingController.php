<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Siswa;
use App\Models\Guru;
use App\Models\Ektrakurikuler;
use App\Models\Pengumuman;
use App\Models\Profil;

class LandingController extends Controller
{
    public function index()
    {
        $profils = Profil::first();
        // Mengambil 3 berita terbaru
        // yang statusnya Publish
        $beritas = Berita::where('status', 'Publish')
            ->latest('tanggal')
            ->take(3)
            ->get();
        $gurus = Guru::latest('id_guru')
            ->take(4)
            ->get();
        $pengumumen = Pengumuman::latest('tanggal')
            ->take(3)
            ->get();

        $jumlahSiswa = Siswa::count();
        $jumlahGuru = Guru::count();
        $jumlahEkstrakurikuler = Ektrakurikuler::count();

        return view('landing_page', compact(
            'beritas',
            'gurus',
            'profils',
            'pengumumen',
            'jumlahSiswa',
            'jumlahGuru',
            'jumlahEkstrakurikuler'
        ));
    }
}
