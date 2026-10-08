@extends('layouts.landing')

@section('title', $galeris->judul)

@section('content')
<section class="py-5 bg-light">
    <div class="container py-4">
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            @if($galeris->file)
                <div class="ratio ratio-21x9">
                    <img src="{{ asset('uploads/galeri/' . $galeris->file) }}" alt="{{ $galeris->judul }}" class="w-100 h-100 object-fit-cover">
                </div>
            @else
                <div class="ratio ratio-21x9 bg-gradient-sekolah d-flex align-items-center justify-content-center">
                    <i class="bi bi-images text-white display-1"></i>
                </div>
            @endif

            <div class="card-body p-4 p-lg-5">
                <div class="mb-3">
                    <span class="badge bg-gradient-sekolah text-white rounded-pill px-3 py-2">
                        <i class="bi bi-images me-1"></i>
                        {{ $galeris->kategori }}
                    </span>
                </div>

                <h1 class="fw-bold text-dark mb-3">{{ $galeris->judul }}</h1>

                <div class="d-flex align-items-center text-muted mb-4">
                    <div class="bg-light rounded-3 p-3 me-3">
                        <i class="bi bi-calendar3 text-gradient-sekolah fs-5"></i>
                    </div>
                    <div>
                        <small class="text-muted d-block mb-1">Tanggal Dokumentasi</small>
                        <strong class="text-dark">
                            {{ \Carbon\Carbon::parse($galeris->tanggal)->translatedFormat('d F Y') }}
                        </strong>
                    </div>
                </div>

                <hr class="mb-4">

                <div>
                    <h5 class="fw-bold text-dark mb-3">
                        <i class="bi bi-info-circle-fill text-gradient-sekolah me-2"></i>
                        Tentang Dokumentasi
                    </h5>
                    <p class="text-muted lh-lg mb-0">
                        {{ $galeris->keterangan ?: 'Belum ada keterangan untuk dokumentasi ini.' }}
                    </p>
                </div>
            </div>
        </div>

        <div class="mt-4">
            <a href="{{ route('home') }}" class="btn btn-outline-primary rounded-3 px-4">
                <i class="bi bi-arrow-left me-2"></i>
                Kembali ke Beranda
            </a>
        </div>
    </div>
</section>
@endsection