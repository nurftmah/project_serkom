@extends('layouts.landing')
@section('title', 'Tentang')
@section('content')
<section class="py-5 bg-light">
    <div class="container py-4">
        <div class="text-center mb-5">
            <span class="badge bg-gradient-sekolah text-white rounded-pill px-3 py-2 mb-3">
                <i class="bi bi-building me-1"></i>
                Tentang Sekolah
            </span>
            <h1 class="fw-bold text-dark mb-2">{{ $profils->nama_sekolah ?? 'MTS AL-AZHAR' }}</h1>
            <p class="text-muted mb-0">Mengenal lebih dekat profil dan informasi sekolah</p>
        </div>
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
            <div class="row g-0 align-items-stretch">
                <div class="col-lg-5 d-flex">
                    @if($profils && $profils->foto && \Illuminate\Support\Facades\Storage::disk('public')->exists('profil/' . $profils->foto))
                        <div class="ratio ratio-4x3 w-100">
                            <img src="{{ asset('storage/profil/' . $profils->foto) }}" alt="{{ $profils->nama_sekolah ?? 'Sekolah' }}" class="w-100 h-100 object-fit-cover">
                        </div>
                    @else
                        <div class="ratio ratio-4x3 bg-light w-100 d-flex align-items-center justify-content-center">
                            <i class="bi bi-building text-secondary display-1"></i>
                        </div>
                    @endif
                </div>
                <div class="col-lg-7 d-flex">
                    <div class="card-body p-4 p-lg-5 d-flex flex-column justify-content-center">
                        <span class="badge bg-gradient-sekolah text-white rounded-pill px-3 py-2 align-self-start mb-3">
                            <i class="bi bi-info-circle-fill me-1"></i>
                            Tentang Kami
                        </span>
                        <h2 class="fw-bold text-dark mb-3">Tentang {{ $profils->nama_sekolah ?? 'MTS AL-AZHAR' }}</h2>
                        <p class="text-muted lh-lg mb-0">{{ $profils->deskripsi ?? 'Belum ada deskripsi sekolah.' }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-body p-4 p-lg-5">
                <div class="d-flex align-items-center mb-4">
                    <div class="bg-gradient-sekolah text-white rounded-3 p-3 me-3">
                        <i class="bi bi-building fs-4"></i>
                    </div>
                    <div>
                        <h4 class="fw-bold text-dark mb-1">Profil Sekolah</h4>
                        <p class="text-muted mb-0">Informasi umum {{ $profils->nama_sekolah ?? 'MTS AL-AZHAR' }}</p>
                    </div>
                </div>
                <div class="row g-4">
                    <div class="col-md-6">
                        <small class="text-muted d-block mb-1">Nama Sekolah</small>
                        <h6 class="fw-bold text-dark mb-0">{{ $profils->nama_sekolah ?? 'Belum tersedia' }}</h6>
                    </div>
                    <div class="col-md-6">
                        <small class="text-muted d-block mb-1">Kepala Sekolah</small>
                        <h6 class="fw-bold text-dark mb-0">{{ $profils->kepala_sekolah ?? 'Belum tersedia' }}</h6>
                    </div>
                    <div class="col-md-6">
                        <small class="text-muted d-block mb-1">NPSN</small>
                        <h6 class="fw-bold text-dark mb-0">{{ $profils->npsn ?? 'Belum tersedia' }}</h6>
                    </div>
                    <div class="col-md-6">
                        <small class="text-muted d-block mb-1">Tahun Berdiri</small>
                        <h6 class="fw-bold text-dark mb-0">{{ $profils->tahun_berdiri ?? 'Belum tersedia' }}</h6>
                    </div>
                    <div class="col-md-6">
                        <small class="text-muted d-block mb-1">Alamat</small>
                        <h6 class="fw-bold text-dark mb-0">
                            <i class="bi bi-geo-alt-fill text-gradient-sekolah me-1"></i>
                            {{ $profils->alamat ?? 'Belum tersedia' }}
                        </h6>
                    </div>
                    <div class="col-md-6">
                        <small class="text-muted d-block mb-1">Kontak</small>
                        <h6 class="fw-bold text-dark mb-0">
                            <i class="bi bi-telephone-fill text-gradient-sekolah me-1"></i>
                            {{ $profils->kontak ?? 'Belum tersedia' }}
                        </h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-body p-4 p-lg-5">
                        <h4 class="fw-bold text-dark mb-3">
                            <i class="bi bi-eye-fill text-gradient-sekolah me-2"></i>
                            Visi
                        </h4>
                        <p class="text-muted lh-lg mb-0">{{ $profils->visi ?? 'Belum ada visi sekolah.' }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-body p-4 p-lg-5">
                        <h4 class="fw-bold text-dark mb-3">
                            <i class="bi bi-bullseye text-gradient-sekolah me-2"></i>
                            Misi
                        </h4>
                        <p class="text-muted lh-lg mb-0">{{ $profils->misi ?? 'Belum ada misi sekolah.' }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-4">
            <a href="{{ route('home') }}" class="btn btn-outline-success rounded-3">
                <i class="bi bi-arrow-left me-2"></i>
                Kembali ke Beranda
            </a>
        </div>
    </div>
</section>
@endsection
