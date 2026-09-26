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
use App\Http\Controllers\UserController;


// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
Route::get('/profil', [ProfilController::class, 'index'])->name('admin.profil');
Route::get('/berita', [BeritaController::class, 'index'])->name('admin.berita');
Route::get('/pengumuman', [PengumumanController::class, 'index'])->name('admin.pengumuman');
Route::get('/guru', [GuruController::class, 'index'])->name('admin.guru');
Route::get('/siswa', [SiswaController::class, 'index'])->name('admin.siswa');
Route::get('/ekstrakurikuler', [EktrakurikulerController::class, 'index'])->name('admin.ektrakurikuler');
Route::get('/galeri', [GaleriController::class, 'index'])->name('admin.galeri');
Route::get('/prestasi', [PrestasiController::class, 'index'])->name('admin.prestasi');


// =========================
// CRUD GURU
// =========================

Route::get('/guru', [GuruController::class, 'index'])
    ->name('admin.guru.index');

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

//PROFIL
Route::get('/profil', [ProfilController::class, 'index']) ->name('admin.profil');
Route::put('/profil/{id}', [ProfilController::class, 'update']) ->name('admin.profil.update');

// PENGELOLA WEB
Route::get('/user', [UserController::class, 'index']) ->name('admin.user.index');
Route::get('/user/create', [UserController::class, 'create'])->name('admin.user.create');
Route::post('/user', [UserController::class, 'store'])->name('admin.user.store');
Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('admin.user.edit');
Route::put('/user/{id}', [UserController::class, 'update'])->name('admin.user.update');
Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('admin.user.destroy');

// SISWA
Route::get('/siswa', [SiswaController::class, 'index'])->name('admin.siswa.index');
Route::get('/siswa/create', [SiswaController::class, 'create'])->name('admin.siswa.create');
Route::post('/siswa', [SiswaController::class, 'store'])->name('admin.siswa.store');
Route::get('/siswa/{id}/edit', [SiswaController::class, 'edit']) ->name('admin.siswa.edit');
Route::put('/siswa/{id}', [SiswaController::class, 'update'])->name('admin.siswa.update');
Route::delete('/siswa/{id}', [SiswaController::class, 'destroy'])->name('admin.siswa.destroy');

// EKSTRAKURIKULER
Route::get('/ekstrakurikuler', [EktrakurikulerController::class, 'index'])->name('admin.ekstrakurikuler.index');
Route::get('/ekstrakurikuler/create', [EktrakurikulerController::class, 'create'])->name('admin.ekstrakurikuler.create');
Route::post('/ekstrakurikuler', [EktrakurikulerController::class, 'store'])->name('admin.ekstrakurikuler.store');
Route::get('/ekstrakurikuler/{id}/edit', [EktrakurikulerController::class, 'edit'])->name('admin.ekstrakurikuler.edit');
Route::put('/ekstrakurikuler/{id}', [EktrakurikulerController::class, 'update'])->name('admin.ekstrakurikuler.update');
Route::delete('/ekstrakurikuler/{id}', [EktrakurikulerController::class, 'destroy'])->name('admin.ekstrakurikuler.destroy');

// BERITA
Route::get('/berita', [BeritaController::class, 'index'])->name('admin.berita.index');
Route::get('/berita/create', [BeritaController::class, 'create'])->name('admin.berita.create');
Route::post('/berita', [BeritaController::class, 'store'])->name('admin.berita.store');
Route::get('/berita/{id}/edit', [BeritaController::class, 'edit'])->name('admin.berita.edit');
Route::put('/berita/{id}', [BeritaController::class, 'update'])->name('admin.berita.update');
Route::delete('/berita/{id}', [BeritaController::class, 'destroy'])->name('admin.berita.destroy');

// GALERI
Route::get('/galeri', [GaleriController::class, 'index'])
    ->name('admin.galeri.index');

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


// PENGUMUMAN
Route::get('/pengumuman', [PengumumanController::class, 'index'])
    ->name('admin.pengumuman.index');

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


// PRESTASI
Route::get('/prestasi', [PrestasiController::class, 'index'])
    ->name('admin.prestasi.index');

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
