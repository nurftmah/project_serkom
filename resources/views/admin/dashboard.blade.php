@extends('layouts.admin')

@section('content')

  <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">

<div class="school-dashboard">

    <!-- =====================================================
         WELCOME
    ====================================================== -->

    <div class="dashboard-welcome">

        <div class="welcome-content">

            <div class="welcome-small">
                SISTEM INFORMASI SEKOLAH
            </div>

           <h1 class="welcome-title">
                Selamat Datang,
                @auth
                    {{ ucfirst(Auth::user()->username) }}
                @else
                    Administrator
                @endauth
                👋
            </h1>

            <p class="welcome-text">
                Kelola informasi sekolah, data guru, siswa,
                berita, galeri, dan prestasi dengan mudah.
            </p>

        </div>

    </div>


    <!-- =====================================================
         STATISTIK
    ====================================================== -->

    <div class="row g-4 mb-4">

        <!-- TOTAL GURU -->
        <div class="col-xl-3 col-md-6">

            <div class="school-stat">

                <div class="school-stat-top">

                    <div class="school-stat-icon">
                        <i class="bi bi-person-workspace"></i>
                    </div>

                    <i class="bi bi-three-dots school-stat-arrow"></i>

                </div>

                <div class="school-stat-label">
                    Total Guru
                </div>

                <div class="school-stat-number">
                    {{ $totalGuru }}
                </div>

                <div class="school-stat-info">
                    Guru terdaftar di sekolah
                </div>

            </div>

        </div>


        <!-- TOTAL SISWA -->
        <div class="col-xl-3 col-md-6">

            <div class="school-stat">

                <div class="school-stat-top">

                    <div class="school-stat-icon">
                        <i class="bi bi-people-fill"></i>
                    </div>

                    <i class="bi bi-three-dots school-stat-arrow"></i>

                </div>

                <div class="school-stat-label">
                    Total Siswa
                </div>

                <div class="school-stat-number">
                    {{ $totalSiswa }}
                </div>

                <div class="school-stat-info">
                    Siswa terdaftar
                </div>

            </div>

        </div>


        <!-- TOTAL BERITA -->
        <div class="col-xl-3 col-md-6">

            <div class="school-stat">

                <div class="school-stat-top">

                    <div class="school-stat-icon">
                        <i class="bi bi-newspaper"></i>
                    </div>

                    <i class="bi bi-three-dots school-stat-arrow"></i>

                </div>

                <div class="school-stat-label">
                    Total Berita
                </div>

                <div class="school-stat-number">
                    {{ $totalBerita }}
                </div>

                <div class="school-stat-info">
                    Berita sekolah
                </div>

            </div>

        </div>


        <!-- TOTAL PRESTASI -->
        <div class="col-xl-3 col-md-6">

            <div class="school-stat">

                <div class="school-stat-top">

                    <div class="school-stat-icon">
                        <i class="bi bi-trophy-fill"></i>
                    </div>

                    <i class="bi bi-three-dots school-stat-arrow"></i>

                </div>

                <div class="school-stat-label">
                    Total Prestasi
                </div>

                <div class="school-stat-number">
                    {{ $totalPrestasi }}
                </div>

                <div class="school-stat-info">
                    Prestasi sekolah
                </div>

            </div>

        </div>

    </div>



    <!-- =====================================================
         BERITA + PENGUMUMAN
    ====================================================== -->

    <div class="row g-4 mb-4">

        <!-- BERITA -->
        <div class="col-lg-7">

            <div class="school-card">

                <div class="school-card-header">

                    <h2 class="school-card-title">
                        Berita Terbaru
                    </h2>

                    <a href="{{ route('admin.berita.index') }}"
                       class="school-card-link">

                        Lihat Semua

                    </a>

                </div>


                @forelse($beritaTerbaru as $berita)

                    <div class="news-item">

                        <div class="news-image">

                            <i class="bi bi-newspaper"></i>

                        </div>

                        <div class="news-content">

                            <div class="news-title">
                                {{ $berita->judul }}
                            </div>

                            <div class="news-date">

                                {{ \Carbon\Carbon::parse($berita->tanggal)->format('d M Y') }}

                            </div>

                        </div>

                    </div>

                @empty

                    <div class="empty-data">

                        <i class="bi bi-newspaper"></i>

                        <span>
                            Belum ada berita.
                        </span>

                    </div>

                @endforelse

            </div>

        </div>



        <!-- PENGUMUMAN -->
        <div class="col-lg-5">

            <div class="school-card">

                <div class="school-card-header">

                    <h2 class="school-card-title">
                        Pengumuman
                    </h2>

                    <a href="{{ route('admin.pengumuman.index') }}"
                       class="school-card-link">

                        Lihat Semua

                    </a>

                </div>


                @forelse($pengumumanTerbaru as $pengumuman)

                    <div class="announcement-item">

                        <div class="announcement-icon">

                            <i class="bi bi-megaphone-fill"></i>

                        </div>

                        <div>

                            <div class="announcement-title">

                                {{ $pengumuman->judul }}

                            </div>

                            <div class="announcement-date">

                                {{ \Carbon\Carbon::parse($pengumuman->tanggal)->format('d M Y') }}

                            </div>

                        </div>

                    </div>

                @empty

                    <div class="empty-data">

                        <i class="bi bi-megaphone"></i>

                        <span>
                            Belum ada pengumuman.
                        </span>

                    </div>

                @endforelse

            </div>

        </div>

    </div>



    <!-- =====================================================
         PRESTASI + AKSES CEPAT
    ====================================================== -->

    <div class="row g-4 mb-4">


        <!-- =================================================
             PRESTASI TERBARU
        ================================================== -->

        <div class="col-lg-6">

            <div class="school-card">

                <div class="school-card-header">

                    <h2 class="school-card-title">
                        Prestasi Terbaru
                    </h2>

                    <a href="{{ route('admin.prestasi.index') }}"
                       class="school-card-link">

                        Lihat Semua

                    </a>

                </div>


                @forelse($prestasiTerbaru as $prestasi)

                    <div class="achievement-item">


                        <!-- FOTO PRESTASI -->

                        <div class="achievement-image">

                            @if($prestasi->foto)

                                <img
                                     src="{{ asset('uploads/prestasi/' . $prestasi->foto) }}"
                                     alt="{{ $prestasi->nama_prestasi }}"
                                >

                            @else

                                <div class="achievement-no-image">

                                    <i class="bi bi-trophy-fill"></i>

                                </div>

                            @endif

                        </div>


                        <!-- DATA PRESTASI -->

                        <div class="achievement-content">

                            <div class="achievement-title">

                                {{ $prestasi->nama_prestasi }}

                            </div>

                            <div class="achievement-info">

                                {{ $prestasi->tahun_ajaran }}

                            </div>

                            @if(!empty($prestasi->deskripsi))

                                <div class="achievement-description">

                                    {{ $prestasi->deskripsi }}

                                </div>

                            @endif

                        </div>

                    </div>

                @empty

                    <div class="empty-data">

                        <i class="bi bi-trophy"></i>

                        <span>
                            Belum ada prestasi.
                        </span>

                    </div>

                @endforelse

            </div>

        </div>



        <!-- =================================================
             AKSES CEPAT
        ================================================== -->

        <div class="col-lg-6">

            <div class="school-card">

                <div class="school-card-header">

                    <h2 class="school-card-title">
                        Akses Cepat
                    </h2>

                </div>


                <div class="quick-menu-grid">


                    <!-- GURU -->

                    <a href="{{ route('admin.guru.index') }}"
                       class="quick-menu">

                        <i class="bi bi-person-workspace"></i>

                        <span>
                            Data Guru
                        </span>

                    </a>


                    <!-- SISWA -->

                    <a href="{{ route('admin.siswa.index') }}"
                       class="quick-menu">

                        <i class="bi bi-people-fill"></i>

                        <span>
                            Data Siswa
                        </span>

                    </a>


                    <!-- BERITA -->

                    <a href="{{ route('admin.berita.index') }}"
                       class="quick-menu">

                        <i class="bi bi-newspaper"></i>

                        <span>
                            Berita
                        </span>

                    </a>


                    <!-- GALERI -->

                    <a href="{{ route('admin.galeri.index') }}"
                       class="quick-menu">

                        <i class="bi bi-images"></i>

                        <span>
                            Galeri
                        </span>

                    </a>


                    <!-- PROFIL -->

                    <a href="{{ route('admin.profil') }}"
                       class="quick-menu">

                        <i class="bi bi-building"></i>

                        <span>
                            Profil Sekolah
                        </span>

                    </a>


                    <!-- EKSTRAKURIKULER -->

                    <a href="{{ route('admin.ekstrakurikuler.index') }}"
                       class="quick-menu">

                        <i class="bi bi-trophy-fill"></i>

                        <span>
                            Ekstrakurikuler
                        </span>

                    </a>

                </div>

            </div>

        </div>

    </div>



    <!-- =========================
        GALERI
    ========================= -->

    <div class="row g-4">

        <div class="col-12">

            <div class="school-card">

                <div class="school-card-header">

                    <h2 class="school-card-title">
                        Galeri Kegiatan Sekolah
                    </h2>

                    <a href="{{ route('admin.galeri.index') }}"
                    class="school-card-link">

                        Lihat Galeri

                    </a>

                </div>


                <div class="gallery-box">

                    @forelse($galeriTerbaru as $galeri)

                        @if($galeri->file)

                            <div class="gallery-item">

                                <img
                                    src="{{ asset('uploads/galeri/' . $galeri->file) }}"
                                    alt="{{ $galeri->judul }}"
                                >

                            </div>

                        @endif

                    @empty

                        <div class="gallery-empty">

                            <i class="bi bi-images"></i>

                            <p>
                                Belum ada foto galeri.
                            </p>

                        </div>

                    @endforelse

                </div>

            </div>

        </div>

    </div>


</div>

@endsection
