<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>MTS AL-AZHAR</title>

    <link rel="icon" type="image/png" href="{{ asset('assets/images/logo_mts.png') }}">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('assets/libs/bootstrap/css/bootstrap.min.css') }}">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="{{ asset('assets/libs/bootstrap-icons/bootstrap-icons.css') }}">

    <!-- CSS Utama -->
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
</head>

<body>

    <!-- ================= SIDEBAR ================= -->
    <div class="sidebar-wrapper" id="sidebar">

        <!-- LOGO -->
        <a href="{{ route('admin.dashboard') }}" class="sidebar-brand text-decoration-none">

            <div class="brand-icon">
               <img src="{{ asset('assets/images/logo_mts.png') }}" alt="Logo MTS Al-Azhar">
            </div>

            <span>MTS AL-AZHAR</span>

        </a>


        <!-- MENU -->
        <div class="flex-grow-1 overflow-y-auto">

            <!-- ================= MENU UTAMA ================= -->
            <div class="sidebar-menu-section">

                <div class="sidebar-menu-title">
                    MENU UTAMA
                </div>

                <ul class="sidebar-menu-list">

                    <!-- Dashboard -->
                    <li class="sidebar-menu-item">

                        <a href="{{ route('admin.dashboard') }}"
                           class="sidebar-menu-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">

                            <i class="bi bi-house-door-fill"></i>

                            <span>Dashboard</span>

                        </a>

                    </li>


                    <!-- User -->
                   @auth
                        @if(Auth::user()->role === 'Admin')

                            <li class="sidebar-menu-item">

                                <a href="{{ route('admin.user.index') }}"
                                class="sidebar-menu-link {{ request()->routeIs('admin.user.*') ? 'active' : '' }}">

                                    <i class="bi bi-person-gear"></i>

                                    <span>User</span>

                                </a>

                            </li>

                        @endif
                    @endauth


                    <!-- Profil Sekolah -->
                    <li class="sidebar-menu-item">

                        <a href="{{ route('admin.profil') }}"
                           class="sidebar-menu-link {{ request()->routeIs('admin.profil') ? 'active' : '' }}">

                            <i class="bi bi-building"></i>

                            <span>Profil Sekolah</span>

                        </a>

                    </li>

                </ul>

            </div>


            <!-- ================= DATA SEKOLAH ================= -->
            <div class="sidebar-menu-section">

                <div class="sidebar-menu-title">
                    DATA SEKOLAH
                </div>

                <ul class="sidebar-menu-list">

                    <!-- Guru -->
                    <li class="sidebar-menu-item">

                        <a href="{{ route('admin.guru.index') }}"
                           class="sidebar-menu-link {{ request()->routeIs('admin.guru.*') ? 'active' : '' }}">

                            <i class="bi bi-person-workspace"></i>

                            <span>Kelola Data Guru</span>

                        </a>

                    </li>


                    <!-- Siswa -->
                    <li class="sidebar-menu-item">

                        <a href="{{ route('admin.siswa.index') }}"
                           class="sidebar-menu-link {{ request()->routeIs('admin.siswa.*') ? 'active' : '' }}">

                            <i class="bi bi-people-fill"></i>

                            <span>Kelola Data Siswa</span>

                        </a>

                    </li>


                    <!-- Ekstrakurikuler -->
                    <li class="sidebar-menu-item">

                        <a href="{{ route('admin.ekstrakurikuler.index') }}"
                           class="sidebar-menu-link {{ request()->routeIs('admin.ekstrakurikuler.*') ? 'active' : '' }}">

                            <i class="bi bi-trophy-fill"></i>

                            <span>Kelola Ekstrakurikuler</span>

                        </a>

                    </li>

                </ul>

            </div>


            <!-- ================= INFORMASI SEKOLAH ================= -->
            <div class="sidebar-menu-section">

                <div class="sidebar-menu-title">
                    INFORMASI SEKOLAH
                </div>

                <ul class="sidebar-menu-list">

                    <!-- Berita -->
                    <li class="sidebar-menu-item">

                        <a href="{{ route('admin.berita.index') }}"
                           class="sidebar-menu-link {{ request()->routeIs('admin.berita.*') ? 'active' : '' }}">

                            <i class="bi bi-newspaper"></i>

                            <span>Kelola Berita</span>

                        </a>

                    </li>


                    <!-- Galeri -->
                    <li class="sidebar-menu-item">

                        <a href="{{ route('admin.galeri.index') }}"
                           class="sidebar-menu-link {{ request()->routeIs('admin.galeri.*') ? 'active' : '' }}">

                            <i class="bi bi-images"></i>

                            <span>Kelola Galeri</span>

                        </a>

                    </li>


                    <!-- Pengumuman -->
                    <li class="sidebar-menu-item">

                        <a href="{{ route('admin.pengumuman.index') }}"
                           class="sidebar-menu-link {{ request()->routeIs('admin.pengumuman.*') ? 'active' : '' }}">

                            <i class="bi bi-megaphone-fill"></i>

                            <span>Kelola Pengumuman</span>

                        </a>

                    </li>


                    <!-- Prestasi -->
                    <li class="sidebar-menu-item">

                        <a href="{{ route('admin.prestasi.index') }}"
                           class="sidebar-menu-link {{ request()->routeIs('admin.prestasi.*') ? 'active' : '' }}">

                            <i class="bi bi-award-fill"></i>

                            <span>Kelola Prestasi</span>

                        </a>

                    </li>

                </ul>

            </div>

        </div>


        <!-- ================================================= -->
        <!-- LINK KE LANDING PAGE -->
        <!-- ================================================= -->

        <a href="{{ url('/') }}"
           class="sidebar-profile text-decoration-none">

            <div class="sidebar-profile-icon">

                <i class="bi bi-globe2"></i>

            </div>

            <div class="sidebar-profile-text">

                <strong>Website Sekolah</strong>

                <small>Lihat Landing Page</small>

            </div>

        </a>


    </div>


    <!-- ================= MAIN ================= -->
    <div class="main-wrapper">


        <!-- ================= NAVBAR ================= -->
        <header class="navbar-custom">

            <div class="navbar-left">

                <!-- Toggle Desktop -->
                <button
                    class="btn-desktop-toggle d-none d-xl-flex align-items-center justify-content-center me-3"
                    id="desktop-sidebar-toggle"
                    aria-label="Minimize Sidebar">

                    <i class="bi bi-chevron-bar-left"></i>

                </button>


                <!-- Toggle Mobile -->
                <button
                    class="sidebar-toggle-btn me-2"
                    id="sidebar-toggle"
                    aria-label="Toggle Navigation">

                    <i class="bi bi-list"></i>

                </button>


                <!-- Judul -->
                <div class="navbar-page-title">

                    <span>
                        SchoolHub
                    </span>

                </div>

            </div>


            <!-- NAVBAR KANAN -->
            <div class="navbar-actions">

                <!-- Notifikasi -->
                <button
                    class="navbar-action-btn"
                    type="button"
                    title="Notifikasi">

                    <i class="bi bi-bell"></i>

                </button>


                <!-- Admin -->
                <div class="dropdown ms-3">

                    <button
                        class="navbar-profile-btn dropdown-toggle"
                        type="button"
                        data-bs-toggle="dropdown"
                        aria-expanded="false">

                        <!-- ICON PROFIL TANPA FOTO -->
                        <div class="navbar-profile-icon">

                            <i class="bi bi-person-fill"></i>

                        </div>


                        <!-- USERNAME -->
                        <span class="navbar-profile-name d-none d-md-inline">

                            @auth
                                {{ Auth::user()->username }}
                            @else
                                Administrator
                            @endauth

                        </span>

                        <i class="bi bi-chevron-down navbar-profile-caret"></i>

                    </button>


                    <!-- DROPDOWN -->
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-profile">

                        <li class="dropdown-header">

                            @auth
                                Akun {{ Auth::user()->username }}
                            @else
                                Akun Administrator
                            @endauth

                        </li>


                        <li>

                            <a
                                class="dropdown-item"
                                href="{{ route('admin.profil') }}">

                                <i class="bi bi-building me-2"></i>

                                Profil Sekolah

                            </a>

                        </li>


                        <li>

                            <a
                                class="dropdown-item"
                                href="{{ route('admin.user.index') }}">

                                <i class="bi bi-person-gear me-2"></i>

                                Pengelola Web

                            </a>

                        </li>


                        <li>

                            <hr class="dropdown-divider">

                        </li>


                        <!-- LOGOUT -->
                        <li>

                            @auth

                                <form
                                    action="{{ route('logout') }}"
                                    method="POST">

                                    @csrf

                                    <button
                                        type="submit"
                                        class="dropdown-item text-danger">

                                        <i class="bi bi-box-arrow-right me-2"></i>

                                        Logout

                                    </button>

                                </form>

                            @else

                                <a
                                    href="{{ route('login')}}"
                                    class="dropdown-item text-danger">

                                    <i class="bi bi-box-arrow-right me-2"></i>

                                    Logout

                                </a>

                            @endauth

                        </li>

                    </ul>

                </div>

            </div>

        </header>


        <!-- ================= CONTENT ================= -->
        <main class="content-wrapper p-4">

            @yield('content')

        </main>


        <!-- ================= FOOTER ================= -->
        <footer class="footer-custom">

            <div class="footer-container">

                <!-- TENTANG SISTEM -->
                <div class="footer-info">

                    <!-- FOOTER BRAND -->
                    <div class="footer-brand">

                        <div class="footer-icon">
                            <img
                                src="{{ asset('assets/images/logo_mts.png') }}"
                                alt="Logo MTS Al-Azhar"
                            >
                        </div>

                        <div>
                            <h6>MTS AL-AZHAR</h6>
                            <p>SchoolHub</p>
                        </div>

                    </div>


                    <p class="footer-description">

                        SchoolHub yang digunakan untuk
                        mengelola data dan informasi sekolah dengan
                        mudah dan terstruktur.

                    </p>

                </div>


                <!-- DATA SEKOLAH -->
                <div class="footer-menu">

                    <h6>Data Sekolah</h6>

                    <a href="{{ route('admin.profil') }}">

                        <i class="bi bi-building"></i>

                        Profil Sekolah

                    </a>


                    <a href="{{ route('admin.guru.index') }}">

                        <i class="bi bi-person-workspace"></i>

                        Data Guru

                    </a>


                    <a href="{{ route('admin.siswa.index') }}">

                        <i class="bi bi-people-fill"></i>

                        Data Siswa

                    </a>


                    <a href="{{ route('admin.ekstrakurikuler.index') }}">

                        <i class="bi bi-trophy-fill"></i>

                        Ekstrakurikuler

                    </a>

                </div>


                <!-- INFORMASI SEKOLAH -->
                <div class="footer-menu">

                    <h6>Informasi Sekolah</h6>


                    <a href="{{ route('admin.berita.index') }}">

                        <i class="bi bi-newspaper"></i>

                        Berita

                    </a>


                    <a href="{{ route('admin.pengumuman.index') }}">

                        <i class="bi bi-megaphone-fill"></i>

                        Pengumuman

                    </a>


                    <a href="{{ route('admin.galeri.index') }}">

                        <i class="bi bi-images"></i>

                        Galeri

                    </a>


                    <a href="{{ route('admin.prestasi.index') }}">

                        <i class="bi bi-award-fill"></i>

                        Prestasi

                    </a>

                </div>


                <!-- KONTAK -->
                <div class="footer-menu">

                    <h6>Kontak</h6>


                    <div class="footer-contact">

                        <i class="bi bi-geo-alt-fill"></i>

                        <span>Alamat Sekolah</span>

                    </div>


                    <div class="footer-contact">

                        <i class="bi bi-telephone-fill"></i>

                        <span>Nomor Telepon</span>

                    </div>


                    <div class="footer-contact">

                        <i class="bi bi-envelope-fill"></i>

                        <span>email@sekolah.com</span>

                    </div>


                    <div class="footer-contact">

                        <i class="bi bi-clock-fill"></i>

                        <span>Senin - Jumat</span>

                    </div>

                </div>

            </div>


            <!-- FOOTER BAWAH -->
            <div class="footer-bottom">

                <div>

                    &copy; 2026 <strong>Admin Sekolah</strong>.
                    Semua hak dilindungi.

                </div>


                <div class="footer-bottom-right">

                    <span>

                        <i class="bi bi-shield-check"></i>
                            SchoolHub

                    </span>


                    <span>

                        Versi 1.0

                    </span>

                </div>

            </div>

        </footer>

    </div>


    <!-- ================= JAVASCRIPT ================= -->

    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('assets/js/dashboard.js') }}"></script>

</body>

</html>
