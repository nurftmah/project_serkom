@extends('layouts.landing')
@section('title', $prestasi->nama_prestasi)
@section('content')
<section class="py-5 bg-light">
    <div class="container py-4">
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            @if($prestasi->foto && \Illuminate\Support\Facades\Storage::disk('public')->exists('prestasi/' . $prestasi->foto))
                <div class="ratio ratio-21x9">
                    <img src="{{ asset('storage/prestasi/' . $prestasi->foto) }}" alt="{{ $prestasi->nama_prestasi }}" class="w-100 h-100 object-fit-cover">
                </div>
            @else
                <div class="ratio ratio-21x9 bg-gradient-sekolah d-flex align-items-center justify-content-center">
                    <i class="bi bi-trophy-fill text-white display-1"></i>
                </div>
            @endif
            <div class="card-body p-4 p-lg-5">
                <div class="mb-3">
                    <span class="badge bg-gradient-sekolah text-white rounded-pill px-3 py-2">
                        <i class="bi bi-trophy-fill me-1"></i>Prestasi
                    </span>
                </div>
                <h1 class="fw-bold text-dark mb-4">{{ $prestasi->nama_prestasi }}</h1>
                <div class="d-flex align-items-center mb-4">
                    <div class="bg-light rounded-3 p-3 me-3">
                        <i class="bi bi-calendar3 text-gradient-sekolah fs-4"></i>
                    </div>
                    <div>
                        <small class="text-muted d-block mb-1">Tahun Ajaran</small>
                        <strong class="text-dark">{{ $prestasi->tahun_ajaran }}</strong>
                    </div>
                </div>
                <hr class="mb-4">
                <div>
                    <h5 class="fw-bold text-dark mb-3">
                        <i class="bi bi-info-circle-fill text-gradient-sekolah me-2"></i>Deskripsi Prestasi
                    </h5>
                    <div class="text-muted lh-lg">
                        {!! nl2br(e($prestasi->deskripsi)) !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-4">
            <a href="{{ route('landing.prestasi') }}" class="btn btn-outline-success rounded-3">
                <i class="bi bi-arrow-left me-2"></i>Kembali ke Prestasi
            </a>
        </div>
    </div>
</section>
@endsection
