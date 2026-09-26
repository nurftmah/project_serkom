@extends('layouts.admin')

@section('content')

<style>

    /* =========================
       DASHBOARD SEKOLAH
    ========================= */

    .school-dashboard {
        color: #1e293b;
    }

    /* HEADER */

    .dashboard-welcome {
        background: linear-gradient(135deg, #0f6b78, #1597a8);
        border-radius: 18px;
        padding: 28px 30px;
        color: white;
        margin-bottom: 25px;
        position: relative;
        overflow: hidden;
    }

    .dashboard-welcome::after {
        content: "";
        position: absolute;
        width: 180px;
        height: 180px;
        border-radius: 50%;
        background: rgba(255,255,255,0.08);
        right: -50px;
        top: -70px;
    }

    .welcome-content {
        position: relative;
        z-index: 2;
    }

    .welcome-small {
        font-size: 13px;
        opacity: 0.85;
        margin-bottom: 5px;
    }

    .welcome-title {
        font-size: 26px;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .welcome-text {
        margin: 0;
        font-size: 13px;
        opacity: 0.9;
    }


    /* =========================
       STATISTIK
    ========================= */

    .school-stat {
        background: white;
        border-radius: 16px;
        padding: 20px;
        border: 1px solid #edf1f5;
        box-shadow: 0 4px 15px rgba(15, 23, 42, 0.04);
        height: 100%;
    }

    .school-stat-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 18px;
    }

    .school-stat-icon {
        width: 46px;
        height: 46px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #e8f7fa;
        color: #1597a8;
        font-size: 20px;
    }

    .school-stat-arrow {
        font-size: 13px;
        color: #94a3b8;
    }

    .school-stat-label {
        font-size: 13px;
        color: #64748b;
        margin-bottom: 4px;
    }

    .school-stat-number {
        font-size: 27px;
        font-weight: 700;
        color: #1e293b;
    }

    .school-stat-info {
        font-size: 11px;
        color: #94a3b8;
        margin-top: 4px;
    }


    /* =========================
       CARD UMUM
    ========================= */

    .school-card {
        background: white;
        border-radius: 16px;
        border: 1px solid #edf1f5;
        padding: 22px;
        box-shadow: 0 4px 15px rgba(15, 23, 42, 0.04);
        height: 100%;
    }

    .school-card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 18px;
    }

    .school-card-title {
        font-size: 17px;
        font-weight: 700;
        margin: 0;
        color: #1e293b;
    }

    .school-card-link {
        font-size: 12px;
        color: #1597a8;
        text-decoration: none;
        font-weight: 600;
    }

    .school-card-link:hover {
        color: #0f6b78;
    }


    /* =========================
       BERITA
    ========================= */

    .news-item {
        display: flex;
        gap: 13px;
        padding: 13px 0;
        border-bottom: 1px solid #f1f5f9;
    }

    .news-item:last-child {
        border-bottom: none;
    }

    .news-image {
        width: 65px;
        height: 55px;
        border-radius: 10px;
        background: #e8f7fa;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #1597a8;
        font-size: 20px;
        flex-shrink: 0;
    }

    .news-content {
        flex: 1;
    }

    .news-title {
        font-size: 13px;
        font-weight: 600;
        color: #334155;
        margin-bottom: 4px;
    }

    .news-date {
        font-size: 11px;
        color: #94a3b8;
    }


    /* =========================
       PENGUMUMAN
    ========================= */

    .announcement-item {
        display: flex;
        gap: 12px;
        padding: 14px;
        margin-bottom: 10px;
        border-radius: 11px;
        background: #f8fafc;
    }

    .announcement-icon {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        background: #fff4e5;
        color: #f59e0b;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .announcement-title {
        font-size: 13px;
        font-weight: 600;
        color: #334155;
        margin-bottom: 3px;
    }

    .announcement-date {
        font-size: 11px;
        color: #94a3b8;
    }


    /* =========================
       PRESTASI
    ========================= */

    .achievement-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 13px 0;
        border-bottom: 1px solid #f1f5f9;
    }

    .achievement-item:last-child {
        border-bottom: none;
    }

    .achievement-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: #fff7df;
        color: #e7a400;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .achievement-title {
        font-size: 13px;
        font-weight: 600;
        color: #334155;
    }

    .achievement-info {
        font-size: 11px;
        color: #94a3b8;
        margin-top: 3px;
    }


    /* =========================
       MENU CEPAT
    ========================= */

    .quick-menu-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
    }

    .quick-menu {
        text-decoration: none;
        background: #f8fafc;
        border: 1px solid #eef2f6;
        border-radius: 12px;
        padding: 15px;
        display: flex;
        align-items: center;
        gap: 10px;
        color: #475569;
        transition: 0.2s;
    }

    .quick-menu:hover {
        background: #e8f7fa;
        color: #1597a8;
        border-color: #c9edf1;
    }

    .quick-menu i {
        width: 34px;
        height: 34px;
        border-radius: 9px;
        background: #e8f7fa;
        color: #1597a8;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .quick-menu span {
        font-size: 12px;
        font-weight: 600;
    }


    /* =========================
       GALERI
    ========================= */

    .gallery-box {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 10px;
    }

    .gallery-item {
        height: 95px;
        border-radius: 11px;
        background: #e8f7fa;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #1597a8;
        font-size: 24px;
    }


    /* =========================
       RESPONSIVE
    ========================= */

    @media (max-width: 768px) {

        .dashboard-welcome {
            padding: 22px;
        }

        .welcome-title {
            font-size: 21px;
        }

        .quick-menu-grid {
            grid-template-columns: 1fr;
        }

        .gallery-box {
            grid-template-columns: repeat(2, 1fr);
        }

    }

</style>


<div class="school-dashboard">


    <!-- =========================
         WELCOME
    ========================= -->

    <div class="dashboard-welcome">

        <div class="welcome-content">

            <div class="welcome-small">
                SISTEM INFORMASI SEKOLAH
            </div>

            <h1 class="welcome-title">
                Selamat Datang, Administrator 👋
            </h1>

            <p class="welcome-text">
                Kelola informasi sekolah, data guru, siswa,
                berita, galeri, dan prestasi dengan mudah.
            </p>

        </div>

    </div>



    <!-- =========================
         STATISTIK SEKOLAH
    ========================= -->

    <div class="row g-4 mb-4">


        <!-- GURU -->

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
                    24
                </div>

                <div class="school-stat-info">
                    Guru aktif di sekolah
                </div>

            </div>

        </div>


        <!-- SISWA -->

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
                    156
                </div>

                <div class="school-stat-info">
                    Siswa terdaftar
                </div>

            </div>

        </div>


        <!-- BERITA -->

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
                    12
                </div>

                <div class="school-stat-info">
                    Berita sekolah
                </div>

            </div>

        </div>


        <!-- PRESTASI -->

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
                    8
                </div>

                <div class="school-stat-info">
                    Prestasi sekolah
                </div>

            </div>

        </div>

    </div>



    <!-- =========================
         BERITA + PENGUMUMAN
    ========================= -->

    <div class="row g-4 mb-4">


        <!-- BERITA TERBARU -->

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


                <div class="news-item">

                    <div class="news-image">
                        <i class="bi bi-newspaper"></i>
                    </div>

                    <div class="news-content">

                        <div class="news-title">
                            Kegiatan Sekolah Bulan September
                        </div>

                        <div class="news-date">
                            18 September 2026
                        </div>

                    </div>

                </div>


                <div class="news-item">

                    <div class="news-image">
                        <i class="bi bi-calendar-event"></i>
                    </div>

                    <div class="news-content">

                        <div class="news-title">
                            Kegiatan Belajar Mengajar Semester Baru
                        </div>

                        <div class="news-date">
                            15 September 2026
                        </div>

                    </div>

                </div>


                <div class="news-item">

                    <div class="news-image">
                        <i class="bi bi-people-fill"></i>
                    </div>

                    <div class="news-content">

                        <div class="news-title">
                            Kegiatan Pertemuan Orang Tua Siswa
                        </div>

                        <div class="news-date">
                            12 September 2026
                        </div>

                    </div>

                </div>

            </div>

        </div>



        <!-- PENGUMUMAN -->

        <div class="col-lg-5">

            <div class="school-card">

                <div class="school-card-header">

                    <h2 class="school-card-title">
                        Pengumuman
                    </h2>

                    <a href="#" class="school-card-link">
                        Lihat Semua
                    </a>

                </div>


                <div class="announcement-item">

                    <div class="announcement-icon">
                        <i class="bi bi-megaphone-fill"></i>
                    </div>

                    <div>

                        <div class="announcement-title">
                            Jadwal Ujian Tengah Semester
                        </div>

                        <div class="announcement-date">
                            17 September 2026
                        </div>

                    </div>

                </div>


                <div class="announcement-item">

                    <div class="announcement-icon">
                        <i class="bi bi-info-circle-fill"></i>
                    </div>

                    <div>

                        <div class="announcement-title">
                            Libur Kegiatan Sekolah
                        </div>

                        <div class="announcement-date">
                            10 September 2026
                        </div>

                    </div>

                </div>


                <div class="announcement-item">

                    <div class="announcement-icon">
                        <i class="bi bi-bell-fill"></i>
                    </div>

                    <div>

                        <div class="announcement-title">
                            Informasi Pembayaran Sekolah
                        </div>

                        <div class="announcement-date">
                            5 September 2026
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>



    <!-- =========================
         PRESTASI + MENU CEPAT
    ========================= -->

    <div class="row g-4 mb-4">


        <!-- PRESTASI -->

        <div class="col-lg-6">

            <div class="school-card">

                <div class="school-card-header">

                    <h2 class="school-card-title">
                        Prestasi Terbaru
                    </h2>

                    <a href="{{ route('admin.ekstrakurikuler.index') }}"
                       class="school-card-link">

                        Lihat Semua

                    </a>

                </div>


                <div class="achievement-item">

                    <div class="achievement-icon">
                        <i class="bi bi-trophy-fill"></i>
                    </div>

                    <div>

                        <div class="achievement-title">
                            Juara 1 Lomba Cerdas Cermat
                        </div>

                        <div class="achievement-info">
                            Tingkat Kecamatan • 2026
                        </div>

                    </div>

                </div>


                <div class="achievement-item">

                    <div class="achievement-icon">
                        <i class="bi bi-award-fill"></i>
                    </div>

                    <div>

                        <div class="achievement-title">
                            Juara 2 Lomba Seni Siswa
                        </div>

                        <div class="achievement-info">
                            Tingkat Kabupaten • 2026
                        </div>

                    </div>

                </div>


                <div class="achievement-item">

                    <div class="achievement-icon">
                        <i class="bi bi-star-fill"></i>
                    </div>

                    <div>

                        <div class="achievement-title">
                            Siswa Berprestasi
                        </div>

                        <div class="achievement-info">
                            Tahun Pelajaran 2025/2026
                        </div>

                    </div>

                </div>

            </div>

        </div>



        <!-- MENU CEPAT -->

        <div class="col-lg-6">

            <div class="school-card">

                <div class="school-card-header">

                    <h2 class="school-card-title">
                        Akses Cepat
                    </h2>

                </div>


                <div class="quick-menu-grid">


                    <a href="{{ route('admin.guru.index') }}"
                       class="quick-menu">

                        <i class="bi bi-person-workspace"></i>

                        <span>
                            Data Guru
                        </span>

                    </a>


                    <a href="{{ route('admin.siswa.index') }}"
                       class="quick-menu">

                        <i class="bi bi-people-fill"></i>

                        <span>
                            Data Siswa
                        </span>

                    </a>


                    <a href="{{ route('admin.berita.index') }}"
                       class="quick-menu">

                        <i class="bi bi-newspaper"></i>

                        <span>
                            Berita
                        </span>

                    </a>


                    <a href="{{ route('admin.galeri.index') }}"
                       class="quick-menu">

                        <i class="bi bi-images"></i>

                        <span>
                            Galeri
                        </span>

                    </a>


                    <a href="{{ route('admin.profil') }}"
                       class="quick-menu">

                        <i class="bi bi-building"></i>

                        <span>
                            Profil Sekolah
                        </span>

                    </a>


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

                    <div class="gallery-item">
                        <i class="bi bi-image"></i>
                    </div>

                    <div class="gallery-item">
                        <i class="bi bi-image"></i>
                    </div>

                    <div class="gallery-item">
                        <i class="bi bi-image"></i>
                    </div>

                    <div class="gallery-item">
                        <i class="bi bi-image"></i>
                    </div>

                    <div class="gallery-item">
                        <i class="bi bi-image"></i>
                    </div>

                    <div class="gallery-item">
                        <i class="bi bi-image"></i>
                    </div>

                </div>

            </div>

        </div>

    </div>


</div>

@endsection
