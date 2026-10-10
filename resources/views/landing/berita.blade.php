@extends('layouts.landing')
@section('title', 'Berita')
@section('content')
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <span class="badge bg-gradient-sekolah px-3 py-2 mb-2">
                <i class="bi bi-newspaper me-1"></i>
                Berita
            </span>
            <h2 class="fw-bold text-dark">Berita Sekolah</h2>
            <p class="text-muted mb-0">Informasi dan berita terbaru dari MTS AL-AZHAR</p>
        </div>
        <div class="row g-4">
            @forelse($beritas as $berita)
                <div class="col-md-6 col-lg-4">
                    <a href="{{ route('landing.berita.show', ['slug' => $berita->slug]) }}" class="text-decoration-none d-block h-100">
                        <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">
                            @if($berita->gambar && \Illuminate\Support\Facades\Storage::disk('public')->exists('berita/' . $berita->gambar))
                                <img src="{{ asset('storage/berita/' . $berita->gambar) }}" class="w-100" style="height:220px; object-fit:cover;" alt="{{ $berita->judul }}">
                            @else
                                <div class="d-flex align-items-center justify-content-center bg-light" style="height:220px;">
                                    <i class="bi bi-newspaper text-muted" style="font-size:70px;"></i>
                                </div>
                            @endif
                            <div class="card-body p-4">
                                <small class="text-success d-block mb-2">
                                    <i class="bi bi-calendar3 me-1"></i>
                                    {{ \Carbon\Carbon::parse($berita->tanggal)->translatedFormat('d F Y') }}
                                </small>
                                <h5 class="fw-bold text-dark mb-3">{{ $berita->judul }}</h5>
                                <p class="text-muted mb-0">
                                    {{ \Illuminate\Support\Str::limit(strip_tags($berita->isi), 120) }}
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <div class="col-12">
                    <div class="text-center py-5">
                        <i class="bi bi-newspaper text-muted" style="font-size:60px;"></i>
                        <h5 class="fw-bold mt-3">Belum Ada Berita</h5>
                        <p class="text-muted mb-0">Belum ada berita sekolah yang tersedia.</p>
                    </div>
                </div>
            @endforelse
        </div>
        <div class="mt-4">
            <a href="{{ route('home') }}" class="btn btn-outline-success rounded-3 px-4">
                <i class="bi bi-arrow-left me-2"></i>
                Kembali ke Beranda
            </a>
        </div>
    </div>
</section>
@endsection
