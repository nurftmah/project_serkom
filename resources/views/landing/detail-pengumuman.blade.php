@extends('layouts.landing')

@section('title', $pengumuman->judul)

@section('content')
<section class="py-5 bg-light">
    <div class="container py-4">
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="card-body p-4 p-lg-5">
                <div class="mb-4">
                    <span class="badge bg-gradient-sekolah rounded-pill px-3 py-2">
                        <i class="bi bi-megaphone-fill me-1"></i>
                        Pengumuman
                    </span>
                </div>

                <h1 class="fw-bold text-dark mb-3">{{ $pengumuman->judul }}</h1>

                <div class="d-flex align-items-center text-muted mb-4">
                    <div class="bg-light rounded-3 p-3 me-3">
                        <i class="bi bi-calendar3 fs-4"></i>
                    </div>
                    <div>
                        <small class="text-muted d-block mb-1">Tanggal Pengumuman</small>
                        <strong class="text-dark">
                            {{ \Carbon\Carbon::parse($pengumuman->tanggal)->format('d F Y') }}
                        </strong>
                    </div>
                </div>

                <hr>

                <div class="mt-4">
                    <h5 class="fw-bold text-dark mb-3">
                        <i class="bi bi-info-circle-fill text-gradient-sekolah me-2"></i>
                        Isi Pengumuman
                    </h5>
                    <div class="text-muted">
                        {!! nl2br(e($pengumuman->isi)) !!}
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-4">
            <a href="{{ route('landing.pengumuman') }}" class="btn btn-outline-success rounded-3">
                <i class="bi bi-arrow-left me-2"></i>
                Kembali ke Pengumuman
            </a>
        </div>
    </div>
</section>
@endsection