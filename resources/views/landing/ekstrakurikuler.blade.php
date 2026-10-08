@extends('layouts.landing')

@section('title', 'Ekstrakurikuler')

@section('content')
<section class="py-5 bg-light">
    <div class="container py-4">
        <div class="text-center mb-5">
            <span class="badge bg-gradient-sekolah rounded-pill px-3 py-2 mb-3">
                <i class="bi bi-trophy-fill"></i>
                Ekstrakurikuler
            </span>
            <h2 class="fw-bold text-dark mb-2">Ekstrakurikuler Sekolah</h2>
            <p class="text-muted mb-0">Berbagai kegiatan untuk mengembangkan bakat dan minat siswa</p>
        </div>

        @if($ekstrakurikulers->count())
            <div class="row g-3">
                @forelse($ekstrakurikulers->take(3) as $ekskul)
                    <div class="col-md-4">
                        <a href="{{ route('landing.ekstrakurikuler.show', ['slug' => $ekskul->slug]) }}" class="text-decoration-none d-block">
                            <div class="card h-100 rounded-4 shadow-sm overflow-hidden">
                                @if($ekskul->gambar)
                                    <div class="ratio ratio-16x9">
                                        <img src="{{ asset('uploads/ekstrakurikuler/' . $ekskul->gambar) }}" alt="{{ $ekskul->nama_ekskul }}" class="object-fit-cover">
                                    </div>
                                @else
                                    <div class="ratio ratio-16x9 bg-light d-flex justify-content-center align-items-center">
                                        <i class="bi bi-stars text-success display-3"></i>
                                    </div>
                                @endif

                                <div class="card-body p-4">
                                    <h5 class="fw-bold text-dark mb-3">{{ $ekskul->nama_ekskul }}</h5>

                                    <div class="mb-2">
                                        <small class="text-muted">
                                            <i class="bi bi-person-fill me-1"></i>
                                            Pembina
                                        </small>
                                        <p class="mb-0 text-dark">{{ $ekskul->pembina }}</p>
                                    </div>

                                    <div class="mb-3">
                                        <small class="text-muted">
                                            <i class="bi bi-calendar3 me-1"></i>
                                            Jadwal Latihan
                                        </small>
                                        <p class="mb-0 text-dark">{{ $ekskul->jadwal_latihan }}</p>
                                    </div>

                                    <p class="text-muted mb-0">
                                        {{ \Illuminate\Support\Str::limit($ekskul->deskripsi, 100) }}
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <i class="bi bi-stars text-muted display-4"></i>
                        <h5 class="fw-bold mt-3">Belum Ada Ekstrakurikuler</h5>
                        <p class="text-muted mb-0">Data ekstrakurikuler sekolah belum tersedia.</p>
                    </div>
                @endforelse
            </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-stars text-muted display-3"></i>
                <h5 class="fw-bold mt-3">Belum Ada Ekstrakurikuler</h5>
                <p class="text-muted mb-0">Data ekstrakurikuler sekolah belum tersedia.</p>
            </div>
        @endif

        <div class="mt-4">
            <a href="{{ url('/') }}" class="btn btn-outline-primary rounded-3 px-4">
                <i class="bi bi-arrow-left me-2"></i>
                Kembali ke Beranda
            </a>
        </div>
    </div>
</section>
@endsection