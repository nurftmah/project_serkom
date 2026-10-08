@extends('layouts.landing')

@section('title', 'Galeri')

@section('content')
<section class="py-5 bg-light">
    <div class="container py-4">
        <div class="text-center mb-5">
            <span class="badge bg-gradient-sekolah text-white rounded-pill px-3 py-2 mb-3">
                <i class="bi bi-images me-1"></i>
                Galeri
            </span>
            <h2 class="fw-bold text-dark mb-2">Galeri Sekolah</h2>
            <p class="text-muted mb-0">Dokumentasi kegiatan dan aktivitas MTS AL-AZHAR</p>
        </div>

        <div class="row g-4">
            @forelse($galeris as $galeri)
                <div class="col-md-6 col-lg-4">
                    <a href="{{ route('landing.galeri.show', ['id' => Crypt::encryptString((string) $galeri->id_galeri)]) }}" class="text-decoration-none d-block h-100">
                        <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">
                            @if($galeri->file)
                                <div class="ratio ratio-16x9">
                                    <img src="{{ asset('uploads/galeri/' . $galeri->file) }}" alt="{{ $galeri->judul }}" class="w-100 h-100 object-fit-cover">
                                </div>
                            @else
                                <div class="ratio ratio-16x9 bg-gradient-sekolah d-flex align-items-center justify-content-center">
                                    <i class="bi bi-images text-white display-4"></i>
                                </div>
                            @endif

                            <div class="card-body p-4 d-flex flex-column">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="badge bg-gradient-sekolah rounded-pill px-3 py-2">
                                        <i class="bi bi-camera-fill me-1"></i>
                                        {{ $galeri->kategori }}
                                    </span>
                                    <small class="text-muted">
                                        <i class="bi bi-calendar3 me-1"></i>
                                        {{ \Carbon\Carbon::parse($galeri->tanggal)->format('d M Y') }}
                                    </small>
                                </div>

                                <h5 class="fw-bold text-dark mb-2">{{ $galeri->judul }}</h5>
                                <p class="text-muted mb-0">
                                    {{ \Illuminate\Support\Str::limit($galeri->keterangan, 120) }}
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center rounded-4 border-0 shadow-sm py-4">
                        <i class="bi bi-images me-2"></i>
                        Belum ada dokumentasi kegiatan sekolah.
                    </div>
                </div>
            @endforelse
        </div>

        <div class="mt-4">
            <a href="{{ url('/') }}" class="btn btn-outline-primary rounded-3 px-4">
                <i class="bi bi-arrow-left me-2"></i>
                Kembali ke Beranda
            </a>
        </div>
    </div>
</section>
@endsection