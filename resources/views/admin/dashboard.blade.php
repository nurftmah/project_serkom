@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')
<div class="school-dashboard">
    <div class="dashboard-welcome">
        <div class="welcome-content">
            <div class="welcome-small">SchoolHub</div>
            <h1 class="welcome-title">
                Selamat Datang,
                @auth
                    {{ ucfirst(Auth::user()->username) }}
                @else
                    Administrator
                @endauth
                👋
            </h1>
            <p class="welcome-text">Kelola informasi sekolah, data guru, siswa, berita, galeri, dan prestasi dengan mudah.</p>
        </div>
    </div>
    <div class="row g-4 mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="school-stat h-100">
                <div class="school-stat-top">
                    <div class="school-stat-icon"><i class="bi bi-person-workspace"></i></div>
                    <i class="bi bi-three-dots school-stat-arrow"></i>
                </div>
                <div class="school-stat-label">Total Guru</div>
                <div class="school-stat-number">{{ $totalGuru }}</div>
                <div class="school-stat-info">Guru terdaftar di sekolah</div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="school-stat h-100">
                <div class="school-stat-top">
                    <div class="school-stat-icon"><i class="bi bi-people-fill"></i></div>
                    <i class="bi bi-three-dots school-stat-arrow"></i>
                </div>
                <div class="school-stat-label">Total Siswa</div>
                <div class="school-stat-number">{{ $totalSiswa }}</div>
                <div class="school-stat-info">Siswa terdaftar</div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="school-stat h-100">
                <div class="school-stat-top">
                    <div class="school-stat-icon"><i class="bi bi-newspaper"></i></div>
                    <i class="bi bi-three-dots school-stat-arrow"></i>
                </div>
                <div class="school-stat-label">Total Berita</div>
                <div class="school-stat-number">{{ $totalBerita }}</div>
                <div class="school-stat-info">Berita sekolah</div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="school-stat h-100">
                <div class="school-stat-top">
                    <div class="school-stat-icon"><i class="bi bi-trophy-fill"></i></div>
                    <i class="bi bi-three-dots school-stat-arrow"></i>
                </div>
                <div class="school-stat-label">Total Prestasi</div>
                <div class="school-stat-number">{{ $totalPrestasi }}</div>
                <div class="school-stat-info">Prestasi sekolah</div>
            </div>
        </div>
    </div>
    <div class="row g-4 mb-4">
        <div class="col-lg-7">
            <div class="school-card h-100">
                <div class="school-card-header">
                    <h2 class="school-card-title">Berita Terbaru</h2>
                    <a href="{{ route('admin.berita.index') }}" class="school-card-link">Lihat Semua</a>
                </div>
                @forelse($beritaTerbaru as $berita)
                    <div class="news-item">
                        <div class="news-image">
                            @if($berita->gambar)
                                <img src="{{ asset('storage/berita/' . $berita->gambar) }}" alt="{{ $berita->judul }}">
                            @else
                                <i class="bi bi-newspaper"></i>
                            @endif
                        </div>
                        <div class="news-content">
                            <div class="news-title">{{ $berita->judul }}</div>
                            <div class="news-date">
                                <i class="bi bi-calendar3 me-1"></i>
                                {{ $berita->tanggal ? \Carbon\Carbon::parse($berita->tanggal)->format('d M Y') : '-' }}
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="empty-data">
                        <i class="bi bi-newspaper"></i>
                        <span>Belum ada berita.</span>
                    </div>
                @endforelse
            </div>
        </div>
        <div class="col-lg-5">
            <div class="school-card h-100">
                <div class="school-card-header">
                    <h2 class="school-card-title">Pengumuman</h2>
                    <a href="{{ route('admin.pengumuman.index') }}" class="school-card-link">Lihat Semua</a>
                </div>
                @forelse($pengumumanTerbaru as $pengumuman)
                    <div class="announcement-item">
                        <div class="announcement-icon"><i class="bi bi-megaphone-fill"></i></div>
                        <div class="flex-grow-1">
                            <div class="announcement-title">{{ $pengumuman->judul }}</div>
                            <div class="announcement-date">
                                <i class="bi bi-calendar3 me-1"></i>
                                {{ $pengumuman->tanggal ? \Carbon\Carbon::parse($pengumuman->tanggal)->format('d M Y') : '-' }}
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="empty-data">
                        <i class="bi bi-megaphone"></i>
                        <span>Belum ada pengumuman.</span>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
    <div class="row g-4 mb-4">
        <div class="col-12">
            <div class="school-card">
                <div class="school-card-header">
                    <h2 class="school-card-title">Prestasi Terbaru</h2>
                    <a href="{{ route('admin.prestasi.index') }}" class="school-card-link">Lihat Semua</a>
                </div>
                @forelse($prestasiTerbaru as $prestasi)
                    <div class="py-3 {{ !$loop->last ? 'border-bottom' : '' }}">
                        <div class="row align-items-center g-3">
                            <div class="col-auto">
                                @if($prestasi->foto)
                                    <img src="{{ asset('storage/prestasi/' . $prestasi->foto) }}" alt="{{ $prestasi->nama_prestasi }}" class="rounded-3" style="width: 58px; height: 58px; object-fit: cover;">
                                @else
                                    <div class="rounded-3 bg-light d-flex align-items-center justify-content-center" style="width: 58px; height: 58px;">
                                        <i class="bi bi-trophy-fill text-secondary fs-4"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="col">
                                <div class="fw-semibold text-dark mb-1">{{ $prestasi->nama_prestasi }}</div>
                                <div class="small text-muted mb-2">
                                    <i class="bi bi-calendar3 me-1"></i>{{ $prestasi->tahun_ajaran }}
                                </div>
                                <div class="small text-muted prestasi-deskripsi">{{ $prestasi->deskripsi }}</div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="empty-data">
                        <i class="bi bi-trophy"></i>
                        <span>Belum ada prestasi.</span>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
    <div class="row g-4">
        <div class="col-12">
            <div class="school-card">
                <div class="school-card-header">
                    <h2 class="school-card-title">Galeri Kegiatan Sekolah</h2>
                    <a href="{{ route('admin.galeri.index') }}" class="school-card-link">Lihat Galeri</a>
                </div>
                <div class="gallery-box">
                    @forelse($galeriTerbaru as $galeri)
                        @if($galeri->file)
                            <div class="gallery-item">
                                @if(in_array(strtolower(pathinfo($galeri->file, PATHINFO_EXTENSION)), ['mp4', 'webm', 'ogg']))
                                    <video controls>
                                        <source src="{{ asset('storage/galeri/' . $galeri->file) }}">
                                        Browser kamu tidak mendukung video.
                                    </video>
                                @else
                                    <img src="{{ asset('storage/galeri/' . $galeri->file) }}" alt="{{ $galeri->judul }}">
                                @endif
                            </div>
                        @endif
                    @empty
                        <div class="gallery-empty">
                            <i class="bi bi-images"></i>
                            <p>Belum ada foto atau video galeri.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
