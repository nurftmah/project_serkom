@extends('layouts.landing')

@section('title', $ekstrakurikulers->nama_ekskul)

@section('content')
<section class="py-5 bg-light">
    <div class="container py-4">
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            @if($ekstrakurikulers->gambar)
                <div class="ratio ratio-21x9">
                    <img src="{{ asset('uploads/ekstrakurikuler/' . $ekstrakurikulers->gambar) }}" alt="{{ $ekstrakurikulers->nama_ekskul }}" class="w-100 h-100 object-fit-cover">
                </div>
            @else
                <div class="ratio ratio-21x9 bg-gradient-sekolah d-flex align-items-center justify-content-center">
                    <i class="bi bi-stars text-white display-1"></i>
                </div>
            @endif

            <div class="card-body p-4 p-lg-5">
                <div class="mb-3">
                    <span class="badge bg-gradient-sekolah text-white rounded-pill px-3 py-2">
                        <i class="bi bi-stars me-1"></i>
                        Ekstrakurikuler
                    </span>
                </div>

                <h1 class="fw-bold text-dark mb-3">{{ $ekstrakurikulers->nama_ekskul }}</h1>

                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <div class="bg-light rounded-3 p-3 h-100 d-flex align-items-center">
                            <div class="bg-white rounded-3 p-3 me-3">
                                <i class="bi bi-person-fill text-gradient-sekolah fs-4"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block mb-1">Pembina</small>
                                <strong class="text-dark">{{ $ekstrakurikulers->pembina ?: 'Belum tersedia' }}</strong>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="bg-light rounded-3 p-3 h-100 d-flex align-items-center">
                            <div class="bg-white rounded-3 p-3 me-3">
                                <i class="bi bi-calendar3 text-gradient-sekolah fs-4"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block mb-1">Jadwal Latihan</small>
                                <strong class="text-dark">{{ $ekstrakurikulers->jadwal_latihan ?: 'Belum tersedia' }}</strong>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="mb-4">

                <div>
                    <h5 class="fw-bold text-dark mb-3">
                        <i class="bi bi-info-circle-fill text-gradient-sekolah me-2"></i>
                        Tentang Ekstrakurikuler
                    </h5>
                    <div class="text-muted lh-lg">
                        {!! nl2br(e($ekstrakurikulers->deskripsi ?: 'Belum ada deskripsi untuk ekstrakurikuler ini.')) !!}
                    </div>
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