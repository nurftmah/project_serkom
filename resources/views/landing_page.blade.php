<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>MTS AL-AZHAR</title>

    <link rel="icon" type="image/png" href="{{ asset('assets/images/logo_mts.png') }}">


    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/libs/bootstrap/css/bootstrap.min.css') }}">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="{{ asset('assets/libs/bootstrap-icons/bootstrap-icons.css') }}">

    <style>
        .bg{
            background-color:#16879a;
        }
        .text{
            color: #16879a;
        }
        .btn-biru{
            background-color: #16879a;
        }
        .berita-card {
            transition: 0.3s;
        }

        .berita-card:hover {
            transform: translateY(-5px);
        }
    </style>

</head>


<body>
    {{-- NAVBAR --}}
    <nav class="navbar navbar-expand-lg bg shadow-sm sticky-top">
        <div class="container">
            {{-- LOGO & NAMA SEKOLAH --}}
            <a href="{{ url('/landing') }}" class="navbar-brand d-flex align-items-center">
                <img src="{{ asset('assets/images/logo_mts.png') }}" width="45" height="45" class="me-2" alt="Logo MTS AL-AZHAR">
                <span class="fw-bold text-white">
                    MTS AL-AZHAR
                </span>
            </a>
            {{-- TOGGLE --}}
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            {{-- MENU --}}
            <div class="collapse navbar-collapse" id="menuNavbar">
                <ul class="navbar-nav ms-auto align-items-lg-center">
                    <!-- BERANDA -->
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#beranda">
                            Beranda
                        </a>
                    </li>

                    <!-- TENTANG -->
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#tentang">
                            Tentang
                        </a>
                    </li>

                    <!-- BERITA -->
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#berita">
                            Berita
                        </a>
                    </li>

                    <!-- PRESTASI -->
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#prestasi">
                            Prestasi
                        </a>
                    </li>

                    <!-- GALERI -->
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#galeri">
                            Galeri
                        </a>
                    </li>


                    <!-- LOGIN -->
                    {{-- <li class="nav-item ms-lg-3 mt-2 mt-lg-0">
                        <a href="{{ route('login') }}" class="btn btn-info text-white">
                            <i class="bi bi-box-arrow-in-right me-1"></i>
                            Login Admin
                        </a>
                    </li> --}}
                </ul>
            </div>
        </div>
    </nav>

    <!-- HERO / BERANDA -->
    <section id="beranda" class="bg-info bg-white text py-5">
        <div class="container py-5">
            <div class="row align-items-center g-4">

                <!-- TEKS -->
                <div class="col-lg-6">
                    <span class="badge bg-white text px-3 py-2 mb-3">
                        Selamat Datang di
                    </span>
                    <h1 class="display-4 fw-bold mb-3">
                        MTS AL-AZHAR
                    </h1>
                    <p class="fs-5 mb-4">
                        Membangun generasi yang berilmu, berakhlak,
                        berprestasi, dan siap menghadapi masa depan.
                    </p>

                    <div class="d-flex gap-2 flex-wrap">
                        <a href="#tentang" class="btn btn-light text-info px-4 py-2">
                            <i class="bi bi-building me-2"></i>
                            Tentang Sekolah
                        </a>

                        <a href="#berita" class="btn btn-outline-light px-4 py-2 text-info">
                            <i class="bi bi-newspaper me-2"></i>
                            Berita
                        </a>
                    </div>
                </div>

                <!-- GAMBAR SEKOLAH -->
                <div class="col-lg-6 text-center">
                    <img src="{{ asset('assets/images/sekolah.png') }}"
                        alt="MTS AL-AZHAR"
                        class="img-fluid rounded-4 shadow-lg">
                </div>

            </div>
        </div>
    </section>

    <!-- PROFIL SEKOLAH -->
    <section id="tentang" class="py-5 bg-light">

        <div class="container py-4">

            <div class="text-center mb-5">

                <span class="badge bg text-white px-3 py-2 mb-2">
                    Profil Sekolah
                </span>

                <h2 class="fw-bold text-dark">
                    Tentang {{ $profils->nama_sekolah ?? 'MTS AL-AZHAR' }}
                </h2>

                <p class="text-muted mb-0">
                    Mengenal lebih dekat {{ $profils->nama_sekolah ?? 'MTS AL-AZHAR' }}
                </p>

            </div>

            <div class="row g-4 align-items-stretch">

                <div class="col-lg-4">

                    <div class="card border-0 shadow-sm rounded-4 h-100">

                        <div class="card-body p-4 text-center">

                            <h4 class="fw-bold text mb-4">
                                <i class="bi bi-person-badge me-2"></i>
                                Kepala Sekolah
                            </h4>

                            @if($profils && $profils->foto)

                                <img
                                    src="{{ asset('uploads/profil/' . $profils->foto) }}"
                                    alt="{{ $profils->kepala_sekolah }}"
                                    class="img-fluid rounded-4 shadow-sm mb-4"
                                    style="width: 100%; height: 280px; object-fit: cover;"
                                >

                            @else

                                <div
                                    class="d-flex align-items-center justify-content-center rounded-4 mb-4"
                                    style="height: 280px; background-color: #f1f5f7;"
                                >
                                    <i
                                        class="bi bi-person-fill text-secondary"
                                        style="font-size: 100px;"
                                    ></i>
                                </div>

                            @endif

                            <h5 class="fw-bold mb-1">
                                {{ $profils->kepala_sekolah ?? 'Belum tersedia' }}
                            </h5>

                            <p class="text mb-0">
                                Kepala Sekolah {{ $profils->nama_sekolah ?? 'MTS AL-AZHAR' }}
                            </p>

                        </div>

                    </div>

                </div>

                <div class="col-lg-8">

                    <div class="card border-0 shadow-sm rounded-4 h-100">

                        <div class="card-body p-4">

                            <h4 class="fw-bold text mb-4">
                                <i class="bi bi-building me-2"></i>
                                Profil Sekolah
                            </h4>

                            <div class="mb-3">

                                <small class="text-muted">
                                    Nama Sekolah
                                </small>

                                <h6 class="fw-bold mb-0">
                                    {{ $profils->nama_sekolah ?? 'Belum tersedia' }}
                                </h6>

                            </div>

                            <div class="mb-3">

                                <small class="text-muted">
                                    Kepala Sekolah
                                </small>

                                <h6 class="fw-bold mb-0">
                                    {{ $profils->kepala_sekolah ?? 'Belum tersedia' }}
                                </h6>

                            </div>

                            <div class="mb-3">

                                <small class="text-muted">
                                    NPSN
                                </small>

                                <h6 class="fw-bold mb-0">
                                    {{ $profils->npsn ?? 'Belum tersedia' }}
                                </h6>

                            </div>

                            <div class="mb-3">

                                <small class="text-muted">
                                    Tahun Berdiri
                                </small>

                                <h6 class="fw-bold mb-0">
                                    {{ $profils->tahun_berdiri ?? 'Belum tersedia' }}
                                </h6>

                            </div>

                            <div class="mb-3">

                                <small class="text-muted">
                                    Alamat
                                </small>

                                <h6 class="fw-bold mb-0">
                                    {{ $profils->alamat ?? 'Belum tersedia' }}
                                </h6>

                            </div>

                            <div>

                                <small class="text-muted">
                                    Kontak
                                </small>

                                <h6 class="fw-bold mb-0">
                                    {{ $profils->kontak ?? 'Belum tersedia' }}
                                </h6>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="row mt-4">

                <div class="col-12">

                    <div class="card border-0 shadow-sm rounded-4">

                        <div class="card-body p-4 p-lg-5">

                            <h4 class="fw-bold text mb-3">
                                Tentang Sekolah
                            </h4>

                            <p class="text-muted lh-lg mb-4">
                                {{ $profils->deskripsi ?? 'Belum ada deskripsi sekolah.' }}
                            </p>

                            <div class="bg-info bg-opacity-10 rounded-4 p-4 mb-3">

                                <h5 class="fw-bold text">
                                    <i class="bi bi-eye me-2"></i>
                                    Visi
                                </h5>

                                <p class="mb-0 text-muted lh-lg">
                                    {{ $profils->visi ?? 'Belum ada visi sekolah.' }}
                                </p>

                            </div>

                            <div class="bg-info bg-opacity-10 rounded-4 p-4">

                                <h5 class="fw-bold text">
                                    <i class="bi bi-bullseye me-2"></i>
                                    Misi
                                </h5>

                                <p
                                    class="mb-0 text-muted lh-lg"
                                    style="white-space: pre-line;"
                                >
                                    {{ $profils->misi ?? 'Belum ada misi sekolah.' }}
                                </p>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

    {{-- JUMLAH --}}
    <section class="py-5 mb-5">
        <div class="container-fluid px-0">
            <div class="bg">

                <div class="row g-0">

                    <div class="col-6 col-md-3">
                        <div class="text-center text-white py-4 px-3">
                            <h2 class="fw-bold mb-1">A</h2>
                            <p class="mb-0">Akreditasi</p>
                        </div>
                    </div>

                    <div class="col-6 col-md-3">
                        <div class="text-center text-white py-4 px-3">
                            <h2 class="fw-bold mb-1">{{ $jumlahSiswa }}+</h2>
                            <p class="mb-0">Siswa</p>
                        </div>
                    </div>

                    <div class="col-6 col-md-3">
                        <div class="text-center text-white py-4 px-3">
                            <h2 class="fw-bold mb-1">{{ $jumlahGuru }}+</h2>
                            <p class="mb-0">Guru & Staf</p>
                        </div>
                    </div>

                    <div class="col-6 col-md-3">
                        <div class="text-center text-white py-4 px-3">
                            <h2 class="fw-bold mb-1">{{ $jumlahEkstrakurikuler }}+</h2>
                            <p class="mb-0">Ekstrakurikuler</p>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>

    {{-- GURU --}}
    <section class="py-5 bg-light">
        <div class="container py-4">

            <div class="text-center mb-5">
                <span class="badge bg text-white px-3 py-2 mb-2">
                    <i class="bi bi-people-fill me-1"></i>
                    Guru
                </span>

                <h2 class="fw-bold text-dark">
                    Guru & Tenaga Pendidik
                </h2>

                <p class="text-muted mb-0">
                    Guru dan tenaga pendidik MTS AL-AZHAR
                </p>
            </div>

            <div class="row g-4 justify-content-center">

                @forelse($gurus as $guru)

                    <div class="col-6 col-md-4 col-lg-3">

                        <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">

                            @if($guru->foto)

                                <div style="height: 250px; background-color: #f1f5f7;">
                                    <img
                                        src="{{ asset('uploads/guru/' . $guru->foto) }}"
                                        alt="{{ $guru->nama_guru }}"
                                        style="width: 100%; height: 100%; object-fit: cover;"
                                    >
                                </div>

                            @else

                                <div
                                    class="d-flex align-items-center justify-content-center"
                                    style="height: 250px; background-color: #f1f5f7;"
                                >
                                    <i
                                        class="bi bi-person-fill text-secondary"
                                        style="font-size: 90px;"
                                    ></i>
                                </div>

                            @endif

                            <div class="card-body text-center p-4">

                                <h5 class="fw-bold text-dark mb-2">
                                    {{ $guru->nama_guru }}
                                </h5>

                                <p class="text-info mb-0">
                                    <i class="bi bi-book me-1"></i>
                                    {{ $guru->mapel }}
                                </p>

                            </div>

                        </div>

                    </div>

                @empty

                    <div class="col-12">
                        <div class="alert alert-info text-center rounded-4">
                            <i class="bi bi-info-circle me-2"></i>
                            Belum ada data guru.
                        </div>
                    </div>

                @endforelse

            </div>

            @if($jumlahGuru > 4)

                <div class="text-center mt-5">

                    <a
                        href="{{ route('home') }}#guru"
                        class="btn btn-biru text-white rounded-3 px-4"
                    >
                        Lihat Semua Guru
                        <i class="bi bi-arrow-right ms-1"></i>
                    </a>

                </div>

            @endif

        </div>
    </section>

    {{-- BERITA --}}
    <section id="berita" class="py-5">

        <div class="container py-4">

            <div class="text-center mb-5">

                <span class="badge bg text-white px-3 py-2 mb-2">
                    <i class="bi bi-newspaper me-1"></i>
                    Berita
                </span>

                <h2 class="fw-bold text-dark">
                    Berita Terbaru
                </h2>

                <p class="text-muted mb-0">
                    Informasi terbaru dari MTS AL-AZHAR
                </p>

            </div>

            <div class="row g-4 justify-content-center">

                @forelse($beritas as $berita)

                    <div class="col-md-6 col-lg-4">

                        <div class="card berita-card border-0 shadow-sm rounded-4 h-100 overflow-hidden">

                            @if($berita->gambar)

                                <div class="ratio ratio-16x9">
                                    <img
                                        src="{{ asset('uploads/berita/' . $berita->gambar) }}"
                                        class="card-img-top object-fit-cover"
                                        alt="{{ $berita->judul }}"
                                    >
                                </div>

                            @else

                                <div class="ratio ratio-16x9 bg-light d-flex align-items-center justify-content-center">
                                    <i class="bi bi-newspaper text-info display-1"></i>
                                </div>

                            @endif

                            <div class="card-body p-4 d-flex flex-column">

                                <small class="text-info mb-2">
                                    <i class="bi bi-calendar3 me-1"></i>
                                    {{ \Carbon\Carbon::parse($berita->tanggal)->format('d F Y') }}
                                </small>

                                <h5 class="fw-bold text-dark mb-3">
                                    {{ $berita->judul }}
                                </h5>

                                <p class="text-muted mb-4">
                                    {{ Str::limit(strip_tags($berita->isi), 120) }}
                                </p>

                                <div class="mt-auto">
                                <a href="{{ route('berita.show', $berita->slug) }}" class="btn btn-info text-white rounded-3">
                                        Baca Selengkapnya
                                        <i class="bi bi-arrow-right ms-1"></i>
                                    </a>
                                </div>

                            </div>

                        </div>

                    </div>

                @empty

                    <div class="col-12">
                        <div class="alert alert-info text-center rounded-4">
                            <i class="bi bi-info-circle me-2"></i>
                            Belum ada berita yang dipublikasikan.
                        </div>
                    </div>

                @endforelse

            </div>

        </div>

    </section>

    {{-- PENGUMUMAN --}}
    <section class="py-5 bg-light">
        <div class="container py-4">

            <div class="text-center mb-5">

                <span class="badge bg text-white px-3 py-2 mb-2">
                    <i class="bi bi-megaphone-fill me-1"></i>
                    Pengumuman
                </span>

                <h2 class="fw-bold text-dark">
                    Pengumuman Terbaru
                </h2>

                <p class="text-muted mb-0">
                    Informasi dan pengumuman terbaru dari MTS AL-AZHAR
                </p>

            </div>

            <div class="row g-4 justify-content-center">

                @forelse($pengumumen as $pengumuman)

                    <div class="col-md-6 col-lg-4">

                        <div class="card border-0 shadow-sm rounded-4 h-100">

                            <div class="card-body p-4">

                                <div class="d-flex align-items-center mb-3">

                                    <div
                                        class="d-flex align-items-center justify-content-center rounded-3 me-3"
                                        style="width: 48px; height: 48px; background-color: #e6f7fa;"
                                    >
                                        <i class="bi bi-megaphone-fill text-info fs-4"></i>
                                    </div>

                                    <div>
                                        <small class="text-info">
                                            <i class="bi bi-calendar3 me-1"></i>
                                            {{ \Carbon\Carbon::parse($pengumuman->tanggal)->format('d F Y') }}
                                        </small>
                                    </div>

                                </div>

                                <h5 class="fw-bold text-dark mb-3">
                                    {{ $pengumuman->judul }}
                                </h5>

                                <p class="text-muted mb-4">
                                    {{ Str::limit(strip_tags($pengumuman->isi), 120) }}
                                </p>

                                <a
                                    href="#"
                                    class="text-info text-decoration-none fw-semibold"
                                >
                                    Baca Pengumuman
                                    <i class="bi bi-arrow-right ms-1"></i>
                                </a>

                            </div>

                        </div>

                    </div>

                @empty

                    <div class="col-12">

                        <div class="alert alert-info text-center rounded-4">
                            <i class="bi bi-info-circle me-2"></i>
                            Belum ada pengumuman.
                        </div>

                    </div>

                @endforelse

            </div>

        </div>
    </section>

    <!-- Bootstrap JS -->
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}">
    </script>


</body>

</html>
