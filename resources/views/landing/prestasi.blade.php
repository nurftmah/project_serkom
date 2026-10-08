@extends('layouts.landing')

@section('title', 'Prestasi')

@section('content')
<section class="py-5 bg-light">
    <div class="container py-4">
        <div class="text-center mb-5">
            <span class="badge bg-gradient-sekolah text-white rounded-pill px-3 py-2 mb-3">
                <i class="bi bi-trophy-fill me-1"></i>
                Prestasi
            </span>
            <h2 class="fw-bold text-dark mb-2">Prestasi MTS AL-AZHAR</h2>
            <p class="text-muted mb-0">Berbagai prestasi yang telah diraih oleh siswa-siswi MTS AL-AZHAR</p>
        </div>

        <div class="row g-4">
            @forelse($prestasis as $prestasi)
                <div class="col-md-6 col-lg-4 d-flex">
                    <a href="{{ route('landing.prestasi.show', ['slug' => $prestasi->slug]) }}" class="text-decoration-none d-flex w-100">
                        <div class="card border-0 shadow-sm rounded-4 overflow-hidden w-100 h-100">
                            @if($prestasi->foto)
                                <div class="ratio ratio-16x9">
                                    <img src="{{ asset('uploads/prestasi/' . $prestasi->foto) }}" alt="{{ $prestasi->nama_prestasi }}" class="w-100 h-100 object-fit-cover">
                                </div>
                            @else
                                <div class="ratio ratio-16x9 bg-white d-flex align-items-center justify-content-center">
                                    <i class="bi bi-trophy-fill text-secondary display-3"></i>
                                </div>
                            @endif

                            <div class="card-body p-4 d-flex flex-column">
                                <div class="mb-3">
                                    <span class="badge bg-gradient-sekolah text-white rounded-pill px-3 py-2">
                                        <i class="bi bi-calendar3 me-1"></i>
                                        {{ $prestasi->tahun_ajaran }}
                                    </span>
                                </div>
                                <h5 class="fw-bold text-dark mb-2">{{ $prestasi->nama_prestasi }}</h5>
                                <p class="text-muted mb-0">
                                    {{ \Illuminate\Support\Str::limit($prestasi->deskripsi, 150) }}
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center rounded-4 border-0 shadow-sm py-4">
                        <i class="bi bi-trophy me-2"></i>
                        Belum ada data prestasi.
                    </div>
                </div>
            @endforelse
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