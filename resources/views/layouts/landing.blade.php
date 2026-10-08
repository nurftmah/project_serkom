<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $profil->nama_sekolah ?? 'MTS AL-AZHAR' }} | @yield('title')</title>

    <link rel="icon"
          type="image/png"
          href="{{ $profil?->logo
              ? asset('uploads/profil/' . $profil->logo)
              : asset('assets/images/logo_mts.png') }}">

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

        .berita-card {
            transition: 0.3s;
        }

        .berita-card:hover {
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

        .navbar .nav-link:hover {
            background-color:#B8CFB3 !important;
            color: white !important;
        }

        .navbar .nav-link.active {
            background-color:#B8CFB3 !important;
            color: white !important;
            font-weight: 600;
        }
    </style>

    @yield('style')
</head>

<body>

   <nav class="navbar navbar-expand-lg bg shadow-sm sticky-top">

    <div class="container">

        <a href="{{ route('home') }}"
           class="navbar-brand d-flex align-items-center">

            <img src="{{ $profil?->logo ? asset('uploads/profil/' . $profil->logo) : asset('assets/images/logo_mts.png') }}"
                width="45"
                height="45"
                class="me-2"
                alt="Logo MTS AL-AZHAR"
            >

            <span class="fw-bold text-white">
                {{ $profils->nama_sekolah ?? 'MTS AL-AZHAR' }}
            </span>

        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuNavbar" aria-controls="menuNavbar" aria-expanded="false" aria-label="Toggle navigation"
        >
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="menuNavbar">

            <ul class="navbar-nav ms-auto align-items-lg-center gap-1">

                <li class="nav-item">
                    <a
                        href="{{ route('home') }}"
                        class="nav-link rounded-3 px-2"
                    >
                        Beranda
                    </a>
                </li>

                <li class="nav-item">
                    <a
                        href="#tentang"
                        class="nav-link rounded-3 px-2 {{ request()->is('tentang*') ? 'active' : '' }}"
                    >
                        Tentang
                    </a>
                </li>

                <li class="nav-item">
                    <a
                        href="{{ route('landing.guru') }}"
                        class="nav-link rounded-3 px-2 {{ request()->is('guru*') ? 'active' : '' }}"
                    >
                        Guru & Staff
                    </a>
                </li>

                <li class="nav-item">
                    <a
                        href="{{ route('landing.ekstrakurikuler') }}"
                        class="nav-link rounded-3 px-2 {{ request()->is('ekstrakurikuler*') ? 'active' : '' }}"
                    >
                        Ekstrakurikuler
                    </a>
                </li>

                <li class="nav-item">
                    <a
                        href="{{ route('landing.prestasi') }}"
                        class="nav-link rounded-3 px-2 {{ request()->is('prestasi*') ? 'active' : '' }}"
                    >
                        Prestasi
                    </a>
                </li>

                <li class="nav-item">
                    <a
                        href="{{ route('landing.berita') }}"
                        class="nav-link rounded-3 px-2 {{ request()->is('berita*') ? 'active' : '' }}"
                    >
                        Berita
                    </a>
                </li>

                <li class="nav-item">
                    <a
                        href="{{ route('landing.pengumuman') }}"
                        class="nav-link rounded-3 px-2 {{ request()->is('pengumuman*') ? 'active' : '' }}"
                    >
                        Pengumuman
                    </a>
                </li>

                <li class="nav-item">
                    <a
                        href="{{ route('landing.galeri') }}"
                        class="nav-link rounded-3 px-2 {{ request()->is('galeri*') ? 'active' : '' }}"
                    >
                        Galeri
                    </a>
                </li>

            </ul>

        </div>

    </div>

</nav>

    @yield('content')

    <footer class="bg-footer text-white py-4 mt-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    <div class="d-flex align-items-center justify-content-center justify-content-md-start">
                        <img
                            src="{{ $profils?->logo
                                ? asset('uploads/profil/' . $profils->logo)
                                : asset('assets/images/logo_mts.png') }}"
                            width="45"
                            height="45"
                            class="me-2"
                            alt="{{ $profils?->nama_sekolah ?? 'Logo Sekolah' }}"
                        >

                        <div>
                            <h6 class="fw-bold mb-0">
                                {{ $profils?->nama_sekolah ?? 'MTS AL-AZHAR' }}
                            </h6>
                            <small>
                                Sekolah Unggul dan Berkarakter
                            </small>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 text-center text-md-end">
                    <small>
                        © {{ date('Y') }} {{ $profils?->nama_sekolah ?? 'MTS AL-AZHAR' }}. All Rights Reserved.
                    </small>
                </div>
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
