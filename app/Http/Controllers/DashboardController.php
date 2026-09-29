<?php

namespace App\Http\Controllers;

use App\Models\Dashboard;
use App\Http\Requests\StoreDashboardRequest;
use App\Http\Requests\UpdateDashboardRequest;
// use Illuminate\Support\Facades\DB;
use App\Models\Guru;
use App\Models\Siswa;
use App\Models\Berita;
use App\Models\Prestasi;
use App\Models\Galeri;
use App\Models\Pengumuman;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $totalGuru = Guru::count();
        $totalSiswa = Siswa::count();
        $totalBerita = Berita::count();
        $totalPrestasi = Prestasi::count();

        $beritaTerbaru = Berita::latest()->take(3)->get();

        $pengumumanTerbaru = Pengumuman::latest()->take(3)->get();

        $prestasiTerbaru = Prestasi::latest()->take(3)->get();

        $galeriTerbaru = Galeri::latest()->take(6)->get();

        return view('admin.dashboard', compact(
            'totalGuru',
            'totalSiswa',
            'totalBerita',
            'totalPrestasi',
            'beritaTerbaru',
            'pengumumanTerbaru',
            'prestasiTerbaru',
            'galeriTerbaru'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDashboardRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Dashboard $dashboard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dashboard $dashboard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDashboardRequest $request, Dashboard $dashboard)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dashboard $dashboard)
    {
        //
    }
}
