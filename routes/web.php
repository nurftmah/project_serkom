<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\EktrakurikulerController;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LandingController;


// LANDING
Route::get('/', [LandingController::class, 'index'])
    ->name('home');

Route::get('/landing', [LandingController::class, 'index'])
    ->name('landing_page');


// AUTH
Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.process');

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');


// DASHBOARD
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('admin.dashboard');


/*
|--------------------------------------------------------------------------
| ADMIN - DATA
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    // Profil Akun
    Route::get('/profil-akun', [UserController::class, 'profile'])
        ->name('admin.user.profil');

    Route::put('/profil-akun', [UserController::class, 'updateProfile'])
        ->name('admin.user.profil.update');


    // Guru
    Route::get('admin/guru', [GuruController::class, 'index'])
        ->name('admin.guru.index');


    // Siswa
    Route::get('/siswa', [SiswaController::class, 'index'])
        ->name('admin.siswa.index');


    // Ekstrakurikuler
    Route::get('admin/ekstrakurikuler', [EktrakurikulerController::class, 'index'])
        ->name('admin.ekstrakurikuler.index');


    // Berita
    Route::get('/admin/berita', [BeritaController::class, 'index'])
        ->name('admin.berita.index');


    // Galeri
    Route::get('admin/galeri', [GaleriController::class, 'index'])
        ->name('admin.galeri.index');


    // Pengumuman
    Route::get('admin/pengumuman', [PengumumanController::class, 'index'])
        ->name('admin.pengumuman.index');


    // Prestasi
    Route::get('admin/prestasi', [PrestasiController::class, 'index'])
        ->name('admin.prestasi.index');
});


/*
|--------------------------------------------------------------------------
| ADMIN - KHUSUS ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware('admin')->group(function () {

    // Profil Sekolah
    Route::get('/profil', [ProfilController::class, 'index'])
        ->name('admin.profil.index');

    Route::get('/profil/edit/{id}', [ProfilController::class, 'edit'])
        ->name('admin.profil.edit');

    Route::put('/profil/{id}', [ProfilController::class, 'update'])
        ->name('admin.profil.update');


    // User / Pengelola Web
    Route::get('/user', [UserController::class, 'index'])
        ->name('admin.user.index');

    Route::get('/user/create', [UserController::class, 'create'])
        ->name('admin.user.create');

    Route::post('/user', [UserController::class, 'store'])
        ->name('admin.user.store');

    Route::get('/user/{id}/edit', [UserController::class, 'edit'])
        ->name('admin.user.edit');

    Route::put('/user/{id}', [UserController::class, 'update'])
        ->name('admin.user.update');

    Route::delete('/user/{id}', [UserController::class, 'destroy'])
        ->name('admin.user.destroy');


    // Guru
    Route::get('/guru/create', [GuruController::class, 'create'])
        ->name('admin.guru.create');

    Route::post('/guru', [GuruController::class, 'store'])
        ->name('admin.guru.store');

    Route::get('/guru/{id}/edit', [GuruController::class, 'edit'])
        ->name('admin.guru.edit');

    Route::put('/guru/{id}', [GuruController::class, 'update'])
        ->name('admin.guru.update');

    Route::delete('/guru/{id}', [GuruController::class, 'destroy'])
        ->name('admin.guru.destroy');


    // Siswa
    Route::get('/siswa/create', [SiswaController::class, 'create'])
        ->name('admin.siswa.create');

    Route::post('/siswa', [SiswaController::class, 'store'])
        ->name('admin.siswa.store');

    Route::get('/siswa/{id}/edit', [SiswaController::class, 'edit'])
        ->name('admin.siswa.edit');

    Route::put('/siswa/{id}', [SiswaController::class, 'update'])
        ->name('admin.siswa.update');

    Route::delete('/siswa/{id}', [SiswaController::class, 'destroy'])
        ->name('admin.siswa.destroy');
});


/*
|--------------------------------------------------------------------------
| ADMIN - EKSTRAKURIKULER
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/profil', [ProfilController::class, 'index'])->name('admin.profil.index');
    Route::get('/profil/edit/{id}', [ProfilController::class, 'edit'])->name('admin.profil.edit');
    Route::put('/profil/{id}', [ProfilController::class, 'update'])->name('admin.profil.update');

    Route::get('/ekstrakurikuler/create', [EktrakurikulerController::class, 'create'])->name('admin.ekstrakurikuler.create');
    Route::post('/ekstrakurikuler', [EktrakurikulerController::class, 'store'])->name('admin.ekstrakurikuler.store');
    Route::get('/ekstrakurikuler/{id}/edit', [EktrakurikulerController::class, 'edit']) ->name('admin.ekstrakurikuler.edit');
    Route::put('/ekstrakurikuler/{id}', [EktrakurikulerController::class, 'update']) ->name('admin.ekstrakurikuler.update');
    Route::delete('/ekstrakurikuler/{id}', [EktrakurikulerController::class, 'destroy']) ->name('admin.ekstrakurikuler.destroy');


    /*
    |--------------------------------------------------------------------------
    | ADMIN - BERITA
    |--------------------------------------------------------------------------
    */

    Route::get('/admin/berita/create', [BeritaController::class, 'create'])
        ->name('admin.berita.create');

    Route::post('/admin/berita', [BeritaController::class, 'store'])
        ->name('admin.berita.store');

    Route::get('/admin/berita/{slug}/edit', [BeritaController::class, 'edit'])
        ->name('admin.berita.edit');

    Route::put('/admin/berita/{slug}', [BeritaController::class, 'update'])
        ->name('admin.berita.update');

    Route::delete('/admin/berita/{slug}', [BeritaController::class, 'destroy'])
        ->name('admin.berita.destroy');


    // Galeri
    Route::get('/galeri/create', [GaleriController::class, 'create'])
        ->name('admin.galeri.create');

    Route::post('/galeri', [GaleriController::class, 'store'])
        ->name('admin.galeri.store');

    Route::get('/galeri/{id}/edit', [GaleriController::class, 'edit'])
        ->name('admin.galeri.edit');

    Route::put('/galeri/{id}', [GaleriController::class, 'update'])
        ->name('admin.galeri.update');

    Route::delete('/galeri/{id}', [GaleriController::class, 'destroy'])
        ->name('admin.galeri.destroy');


    // Pengumuman
    Route::get('/pengumuman/create', [PengumumanController::class, 'create'])
        ->name('admin.pengumuman.create');

    Route::post('/pengumuman', [PengumumanController::class, 'store'])
        ->name('admin.pengumuman.store');

    Route::get('/pengumuman/{id}/edit', [PengumumanController::class, 'edit'])
        ->name('admin.pengumuman.edit');

    Route::put('/pengumuman/{id}', [PengumumanController::class, 'update'])
        ->name('admin.pengumuman.update');

    Route::delete('/pengumuman/{id}', [PengumumanController::class, 'destroy'])
        ->name('admin.pengumuman.destroy');


    // Prestasi
    Route::get('/prestasi/create', [PrestasiController::class, 'create'])
        ->name('admin.prestasi.create');

    Route::post('/prestasi', [PrestasiController::class, 'store'])
        ->name('admin.prestasi.store');

    Route::get('/prestasi/{id}/edit', [PrestasiController::class, 'edit'])
        ->name('admin.prestasi.edit');

    Route::put('/prestasi/{id}', [PrestasiController::class, 'update'])
        ->name('admin.prestasi.update');

    Route::delete('/prestasi/{id}', [PrestasiController::class, 'destroy'])
        ->name('admin.prestasi.destroy');
});


/*
|--------------------------------------------------------------------------
| LANDING
|--------------------------------------------------------------------------
*/

Route::get('/berita', [LandingController::class, 'berita'])->name('landing.berita');
Route::get('/berita/{slug}', [LandingController::class, 'detailBerita'])->name('landing.berita.show');

Route::get('/guru', [LandingController::class, 'guru'])->name('landing.guru');
Route::get('/guru/{id}', [LandingController::class, 'detailGuru'])->name('landing.guru.show');

Route::get('/prestasi', [LandingController::class, 'prestasi']) ->name('landing.prestasi');
Route::get('/prestasi/{slug}', [LandingController::class, 'detailPrestasi'])->name('landing.prestasi.show');

Route::get('/ekstrakurikuler', [LandingController::class, 'ekstrakurikuler'])->name('landing.ekstrakurikuler');
Route::get('/ekstrakurikuler/{slug}', [LandingController::class, 'detailEkskul'])->name('landing.ekstrakurikuler.show');

Route::get('/galeri', [LandingController::class, 'galeri'])->name('landing.galeri');
Route::get('/galeri/{id}', [LandingController::class, 'detailGaleri'])->name('landing.galeri.show');

Route::get('/pengumuman', [LandingController::class, 'pengumuman'])->name('landing.pengumuman');
Route::get('/pengumuman/{id}', [LandingController::class, 'detailPengumuman'])->name('landing.pengumuman.show');

Route::get('/tentang', [LandingController::class, 'tentang'])->name('landing.tentang');
