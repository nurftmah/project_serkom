@extends('layouts.landing')
@section('title', 'Guru')
@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <span class="badge bg-gradient-sekolah text-white px-3 py-2 mb-2">
            <i class="bi bi-people-fill me-1"></i>
            Guru
        </span>
        <h2 class="fw-bold text-dark">Guru & Tenaga Pendidik</h2>
        <p class="text-muted mb-0">Guru dan tenaga pendidik MTS AL-AZHAR</p>
    </div>
    <div class="row g-4">
        @forelse($gurus as $guru)
            <div class="col-md-6 col-lg-4">
                <a href="{{ route('landing.guru.show', ['id' =>Crypt::encryptString((string) $guru->id_guru)]) }}" class="text-decoration-none d-block h-100">
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">
                        @if($guru->foto)
                            <div style="height: 280px; background-color: #f1f5f7;">
                                <img src="{{ asset('storage/guru/' . $guru->foto) }}" alt="{{ $guru->nama_guru }}" style="width: 100%; height: 100%; object-fit: cover;">
                            </div>
                        @else
                            <div class="d-flex align-items-center justify-content-center" style="height: 280px; background-color: #f1f5f7;">
                                <i class="bi bi-person-fill text-secondary" style="font-size: 100px;"></i>
                            </div>
                        @endif
                        <div class="card-body text-center p-4">
                            <h5 class="fw-bold text-dark mb-2">{{ $guru->nama_guru }}</h5>
                            <p class="text-success mb-0">
                                <i class="bi bi-book me-1"></i>
                                {{ $guru->mapel }}
                            </p>
                        </div>
                    </div>
                </a>
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
    <div class="mt-4">
        <a href="{{ url('/') }}" class="btn btn-outline-success rounded-3 px-4">
            <i class="bi bi-arrow-left me-2"></i>
            Kembali ke Beranda
        </a>
    </div>
</div>
@endsection
