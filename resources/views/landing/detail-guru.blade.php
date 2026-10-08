@extends('layouts.landing')

@section('title', $guru->nama_guru)

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="text-center mb-4">
                <span class="badge bg-gradient-sekolah rounded-pill px-3 py-2 mb-3">
                    <i class="bi bi-person-badge me-1"></i>
                    Profil Guru
                </span>
                <h2 class="fw-bold text-dark mb-2">Profil Guru MTS AL-AZHAR</h2>
                <p class="text-muted mb-0">Informasi mengenai guru dan tenaga pendidik sekolah</p>
            </div>

            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="bg-gradient-sekolah text-center p-4">
                    @if($guru->foto)
                        <img src="{{ asset('uploads/guru/' . $guru->foto) }}" alt="{{ $guru->nama_guru }}" class="foto-guru rounded-4 border border-4 border-white shadow">
                    @else
                        <div class="foto-guru bg-white rounded-4 d-inline-flex align-items-center justify-content-center border border-4 border-white shadow">
                            <i class="bi bi-person-fill text-secondary display-4"></i>
                        </div>
                    @endif
                </div>

                <div class="card-body p-4 p-lg-5">
                    <div class="text-center mb-4">
                        <h3 class="fw-bold text-dark mb-2">{{ $guru->nama_guru }}</h3>
                        <span class="badge bg-light text-primary border rounded-pill px-3 py-2">
                            <i class="bi bi-person-workspace me-1"></i>
                            Guru Mata Pelajaran
                        </span>
                    </div>

                    <hr class="mb-4">

                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="bg-light rounded-4 p-4 h-100">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="text-success me-3">
                                        <i class="bi bi-book fs-4"></i>
                                    </div>
                                    <div>
                                        <small class="text-muted d-block">Mata Pelajaran</small>
                                        <strong class="text-dark">{{ $guru->mapel ?: 'Belum tersedia' }}</strong>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="bg-light rounded-4 p-4 h-100">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="text-success me-3">
                                        <i class="bi bi-person-vcard fs-4"></i>
                                    </div>
                                    <div>
                                        <small class="text-muted d-block">NIP</small>
                                        <strong class="text-dark">{{ $guru->nip ?: 'Belum tersedia' }}</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-light rounded-4 p-4 mt-4">
                        <div class="d-flex">
                            <i class="bi bi-info-circle-fill text-success fs-4 me-3"></i>
                            <div>
                                <h6 class="fw-bold mb-1">Tentang Guru</h6>
                                <p class="text-muted mb-0">
                                    Guru MTS AL-AZHAR yang berperan dalam mendampingi dan memberikan pembelajaran kepada siswa sesuai dengan bidang mata pelajaran yang diampu.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-4">
                <a href="{{ route('landing.guru') }}" class="btn btn-outline-primary rounded-3 px-4">
                    <i class="bi bi-arrow-left me-2"></i>
                    Kembali ke Guru
                </a>
                <span class="text-muted small">
                    <i class="bi bi-building me-1"></i>
                    MTS AL-AZHAR
                </span>
            </div>
        </div>
    </div>
</div>
@endsection