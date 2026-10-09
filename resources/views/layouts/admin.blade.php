<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $profil->nama_sekolah ?? 'MTS AL-AZHAR' }} | @yield('title')</title>
    <link rel="icon" type="image/png" href="{{ $profil?->logo ? asset('storage/profil/' . $profil->logo) : asset('assets/images/logo_mts.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('DataTables/datatables.min.css') }}">
</head>
<body>
    {{-- SIDEBAR --}}
    <div class="sidebar-wrapper" id="sidebar">
        <a href="{{ route('admin.dashboard') }}" class="sidebar-brand">
            <div class="sidebar-logo">
                @if($profilSidebar && $profilSidebar->logo)
                    <img src="{{ asset('storage/profil/' . $profilSidebar->logo) }}" alt="Logo Sekolah">
                @else
                    <img src="{{ asset('assets/images/logo_mts.png') }}" alt="Logo Sekolah">
                @endif
            </div>
            <div class="sidebar-school-name">
                {{ $profilSidebar->nama_sekolah ?? 'MTS AL-AZHAR' }}
            </div>
        </a>
        <div class="flex-grow-1 overflow-y-auto">
            <div class="sidebar-menu-section">
                <div class="sidebar-menu-title">MENU UTAMA</div>
                <ul class="sidebar-menu-list">
                    <li class="sidebar-menu-item">
                        <a href="{{ route('admin.dashboard') }}" class="sidebar-menu-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <i class="bi bi-house-door-fill"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    @auth
                        @if(Auth::user()->role === 'Admin')
                            <li class="sidebar-menu-item">
                                <a href="{{ route('admin.user.index') }}" class="sidebar-menu-link {{ request()->routeIs('admin.user.*') ? 'active' : '' }}">
                                    <i class="bi bi-person-gear"></i>
                                    <span>User</span>
                                </a>
                            </li>
                        @endif
                    @endauth
                    <li class="sidebar-menu-item">
                        <a href="{{ route('admin.profil.index') }}" class="sidebar-menu-link {{ request()->routeIs('admin.profil.*') ? 'active' : '' }}">
                            <i class="bi bi-building"></i>
                            <span>Profil Sekolah</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="sidebar-menu-section">
                <div class="sidebar-menu-title">DATA SEKOLAH</div>
                <ul class="sidebar-menu-list">
                    <li class="sidebar-menu-item">
                        <a href="{{ route('admin.guru.index') }}" class="sidebar-menu-link {{ request()->routeIs('admin.guru.*') ? 'active' : '' }}">
                            <i class="bi bi-person-workspace"></i>
                            <span>Kelola Data Guru</span>
                        </a>
                    </li>
                    <li class="sidebar-menu-item">
                        <a href="{{ route('admin.siswa.index') }}" class="sidebar-menu-link {{ request()->routeIs('admin.siswa.*') ? 'active' : '' }}">
                            <i class="bi bi-people-fill"></i>
                            <span>Kelola Data Siswa</span>
                        </a>
                    </li>
                    <li class="sidebar-menu-item">
                        <a href="{{ route('admin.ekstrakurikuler.index') }}" class="sidebar-menu-link {{ request()->routeIs('admin.ekstrakurikuler.*') ? 'active' : '' }}">
                            <i class="bi bi-trophy-fill"></i>
                            <span>Kelola Ekstrakurikuler</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="sidebar-menu-section">
                <div class="sidebar-menu-title">INFORMASI SEKOLAH</div>
                <ul class="sidebar-menu-list">
                    <li class="sidebar-menu-item">
                        <a href="{{ route('admin.berita.index') }}" class="sidebar-menu-link {{ request()->routeIs('admin.berita.*') ? 'active' : '' }}">
                            <i class="bi bi-newspaper"></i>
                            <span>Kelola Berita</span>
                        </a>
                    </li>
                    <li class="sidebar-menu-item">
                        <a href="{{ route('admin.galeri.index') }}" class="sidebar-menu-link {{ request()->routeIs('admin.galeri.*') ? 'active' : '' }}">
                            <i class="bi bi-images"></i>
                            <span>Kelola Galeri</span>
                        </a>
                    </li>
                    <li class="sidebar-menu-item">
                        <a href="{{ route('admin.pengumuman.index') }}" class="sidebar-menu-link {{ request()->routeIs('admin.pengumuman.*') ? 'active' : '' }}">
                            <i class="bi bi-megaphone-fill"></i>
                            <span>Kelola Pengumuman</span>
                        </a>
                    </li>
                    <li class="sidebar-menu-item">
                        <a href="{{ route('admin.prestasi.index') }}" class="sidebar-menu-link {{ request()->routeIs('admin.prestasi.*') ? 'active' : '' }}">
                            <i class="bi bi-award-fill"></i>
                            <span>Kelola Prestasi</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        {{-- LINK LANDING PAGE --}}
        <a href="{{ url('/') }}" class="sidebar-profile text-decoration-none">
            <div class="sidebar-profile-icon">
                <i class="bi bi-globe2"></i>
            </div>
            <div class="sidebar-profile-text">
                <strong>Website Sekolah</strong>
                <small>Lihat Landing Page</small>
            </div>
        </a>
    </div>

    {{-- MAIN --}}
    <div class="main-wrapper">
        <header class="navbar-custom">
            <div class="navbar-left">
                <button class="btn-desktop-toggle d-none d-xl-flex align-items-center justify-content-center me-3" id="desktop-sidebar-toggle" aria-label="Minimize Sidebar">
                    <i class="bi bi-chevron-bar-left"></i>
                </button>
                <button class="sidebar-toggle-btn me-2" id="sidebar-toggle" aria-label="Toggle Navigation">
                    <i class="bi bi-list"></i>
                </button>
                <div class="navbar-page-title">
                    <span>SchoolHub</span>
                </div>
            </div>
            <div class="navbar-actions">
                <div class="dropdown ms-3">
                    <button class="navbar-profile-btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="navbar-profile-icon">
                            <i class="bi bi-person-fill"></i>
                        </div>
                        <span class="navbar-profile-name d-none d-md-inline">
                            @auth
                                {{ Auth::user()->username }}
                            @else
                                Administrator
                            @endauth
                        </span>
                        <i class="bi bi-chevron-down navbar-profile-caret"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-profile">
                        <li>
                            <a href="{{ route('admin.user.profil') }}" class="dropdown-item">
                                <i class="bi bi-person-circle me-2"></i>
                                Profil Akun
                            </a>
                        </li>
                        @auth
                            @if(Auth::user()->role === 'Admin')
                                <li>
                                    <a class="dropdown-item" href="{{ route('admin.user.index') }}">
                                        <i class="bi bi-person-gear me-2"></i>
                                        Pengelola Web
                                    </a>
                                </li>
                            @endif
                        @endauth
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            @auth
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="bi bi-box-arrow-right me-2"></i>
                                        Logout
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('login') }}" class="dropdown-item text-danger">
                                    <i class="bi bi-box-arrow-right me-2"></i>
                                    Login
                                </a>
                            @endauth
                        </li>
                    </ul>
                </div>
            </div>
        </header>

        {{-- CONTENT --}}
        <main class="content-wrapper p-4">
            @yield('content')
        </main>

        {{-- FOOTER --}}
        {{--
        <footer class="text-white py-4 mt-5" style="background-color: #849e83;">
            <div class="container">
                <div class="row align-items-center g-3">
                    <div class="col-md-6">
                        <div class="d-flex align-items-center justify-content-center justify-content-md-start gap-3">
                            <img src="{{ $profils?->logo ? asset('storage/profil/' . $profils->logo) : asset('assets/images/logo_mts.png') }}" width="50" height="50" class="rounded-3 bg-white p-1" style="object-fit: contain;" alt="{{ $profils?->nama_sekolah ?? 'Logo Sekolah' }}">
                            <div>
                                <h6 class="fw-bold mb-1">{{ $profils?->nama_sekolah ?? 'MTS AL-AZHAR' }}</h6>
                                <small class="text-white-50">Sekolah Unggul dan Berkarakter</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <small class="text-white-50">
                            &copy; {{ date('Y') }} {{ $profils?->nama_sekolah ?? 'MTS AL-AZHAR' }}.
                            All Rights Reserved.
                        </small>
                    </div>
                </div>
            </div>
        </footer>
        --}}
    </div>

    {{-- JAVASCRIPT --}}
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="{{ asset('DataTables/datatables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.table').DataTable();
        });
    </script>
</body>
</html>
