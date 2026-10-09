<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $profils?->nama_sekolah ?? 'MTS AL-AZHAR' }} | @yield('title')</title>
    <link rel="icon" type="image/png" href="{{ $profils?->logo ? asset('storage/profil/' . $profils->logo) : asset('assets/images/logo_mts.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/aos/aos.css') }}">
    <style>
        .bg {
            background-color: #84A282 !important;
        }
        .bg-footer {
            background-color: #84A282 !important;
        }
        .text {
            color: #7D9C65;
        }
        .bg-gradient-sekolah {
            background: linear-gradient(135deg, #3d4345, #7D9C65);
        }
        .berita-card,
        .pengumuman-card,
        .ekskul-card,
        .prestasi-card,
        .galeri-card {
            transition: 0.3s;
        }
        .berita-card:hover,
        .pengumuman-card:hover,
        .ekskul-card:hover,
        .prestasi-card:hover,
        .galeri-card:hover {
            transform: translateY(-5px);
        }
        .foto-guru {
            width: 160px;
            height: 170px;
            object-fit: cover;
        }
        .pengumuman-header {
            min-height: 97px;
            padding: 18px;
        }
        .navbar .nav-link {
            color: white !important;
            transition: 0.3s;
        }
        .navbar .nav-link:hover,
        .navbar .nav-link.active {
            background-color: #B8CFB3 !important;
            color: white !important;
        }
        .navbar .nav-link.active {
            font-weight: 600;
        }
        @media (min-width: 992px) {
            .border-start-lg {
                border-left: 1px solid rgba(255, 255, 255, 0.35);
                min-height: 85px;
            }
        }
        @media (max-width: 991.98px) {
            .border-start-lg {
                border-left: 0;
            }
        }
    </style>
    @yield('style')
</head>
<body>
    <nav class="navbar navbar-expand-lg bg shadow-sm sticky-top">
        <div class="container">
            <a href="{{ route('home') }}" class="navbar-brand d-flex align-items-center">
                <img src="{{ $profils?->logo ? asset('storage/profil/' . $profils->logo) : asset('assets/images/logo_mts.png') }}" width="45" height="45" class="me-2" alt="Logo MTS AL-AZHAR">
                <span class="fw-bold text-white">{{ $profils?->nama_sekolah ?? 'MTS AL-AZHAR' }}</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuNavbar" aria-controls="menuNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="menuNavbar">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-1">
                    <li class="nav-item">
                        <a href="{{ route('home') }}" class="nav-link rounded-3 px-2 {{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('landing.tentang') }}" class="nav-link rounded-3 px-2 {{ request()->routeIs('landing.tentang') ? 'active' : '' }}">Tentang</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('landing.guru') }}" class="nav-link rounded-3 px-2 {{ request()->routeIs('landing.guru') ? 'active' : '' }}">Guru &amp; Staff</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('landing.ekstrakurikuler') }}" class="nav-link rounded-3 px-2 {{ request()->routeIs('landing.ekstrakurikuler') ? 'active' : '' }}">Ekstrakurikuler</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('landing.prestasi') }}" class="nav-link rounded-3 px-2 {{ request()->routeIs('landing.prestasi*') ? 'active' : '' }}">Prestasi</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('landing.berita') }}" class="nav-link rounded-3 px-2 {{ request()->routeIs('landing.berita*') ? 'active' : '' }}">Berita</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('landing.pengumuman') }}" class="nav-link rounded-3 px-2 {{ request()->routeIs('landing.pengumuman*') ? 'active' : '' }}">Pengumuman</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('landing.galeri') }}" class="nav-link rounded-3 px-2 {{ request()->routeIs('landing.galeri*') ? 'active' : '' }}">Galeri</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    @yield('content')
    <footer class="text-white mt-5" style="background-color: #849e83;">
        <div class="container py-4 py-lg-5">
            <div class="row align-items-center g-4">
                <div class="col-lg-5">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <img src="{{ $profils?->logo ? asset('storage/profil/' . $profils->logo) : asset('assets/images/logo_mts.png') }}" alt="{{ $profils?->nama_sekolah ?? 'Logo Sekolah' }}" width="55" height="55" class="rounded-3 bg-white p-1" style="object-fit: contain;">
                        <div>
                            <h5 class="fw-bold mb-1">{{ $profils?->nama_sekolah ?? 'MTS AL-AZHAR' }}</h5>
                            <small class="text-white-50">Sekolah Unggul dan Berkarakter</small>
                        </div>
                    </div>
                    <p class="text-white-50 mb-0">Membangun generasi yang berilmu, berakhlak, dan berprestasi.</p>
                </div>
                <div class="col-lg-4 border-start-lg ps-lg-4">
                    <div class="d-flex align-items-start gap-3">
                        <i class="bi bi-geo-alt-fill fs-4"></i>
                        <div>
                            <h6 class="fw-bold mb-2">Alamat Sekolah</h6>
                            <p class="text-white-50 mb-0">{{ $profils?->alamat ?? 'Alamat belum tersedia' }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 border-start-lg ps-lg-4">
                    <div class="d-flex align-items-start gap-3">
                        <i class="bi bi-telephone-fill fs-4"></i>
                        <div>
                            <h6 class="fw-bold mb-2">Kontak Sekolah</h6>
                            <p class="text-white-50 mb-0">{{ $profils?->kontak ?? 'Kontak belum tersedia' }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="border-white opacity-25 my-4">
            <div class="text-center text-white-50 small">
                &copy; {{ date('Y') }} {{ $profils?->nama_sekolah ?? 'MTS AL-AZHAR' }}. All Rights Reserved.
            </div>
        </div>
    </footer>
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/aos/aos.js') }}"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true,
            offset: 100
        });
    </script>
    @yield('script')
</body>
</html>
