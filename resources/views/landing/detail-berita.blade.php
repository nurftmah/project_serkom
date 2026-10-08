@extends('layouts.landing')

@section('title', $berita->judul)

@section('content')
<section class="py-5 bg-light">
    <div class="container py-4">
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            @if($berita->gambar)
                <div class="ratio ratio-21x9">
                    <img src="{{ asset('uploads/berita/' . $berita->gambar) }}" alt="{{ $berita->judul }}" class="w-100 h-100 object-fit-cover">
                </div>
            @else
                <div class="ratio ratio-21x9 bg-gradient-sekolah d-flex align-items-center justify-content-center">
                    <i class="bi bi-newspaper text-white display-1"></i>
                </div>
            @endif

            <div class="card-body p-4 p-lg-5">
                <div class="mb-3">
                    <span class="badge bg-gradient-sekolah text-white rounded-pill px-3 py-2">
                        <i class="bi bi-newspaper me-1"></i>
                        Berita
                    </span>
                </div>

                <h1 class="fw-bold text-dark mb-3">{{ $berita->judul }}</h1>

                <div class="d-flex align-items-center text-muted mb-4">
                    <div class="bg-light rounded-3 p-3 me-3">
                        <i class="bi bi-calendar3 text-gradient-sekolah fs-5"></i>
                    </div>
                    <div>
                        <small class="text-muted d-block mb-1">Tanggal Berita</small>
                        <strong class="text-dark">
                            {{ \Carbon\Carbon::parse($berita->tanggal)->translatedFormat('d F Y') }}
                        </strong>
                    </div>
                </div>

                <hr class="mb-4">

                <div class="berita-content">
                    <h5 class="fw-bold text-dark mb-3">
                        <i class="bi bi-info-circle-fill text-gradient-sekolah me-2"></i>
                        Isi Berita
                    </h5>
                    <div class="text-muted lh-lg">
                        {!! $berita->isi !!}
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

@section('style')
<style>
.berita-content p {
    margin-bottom: 1rem;
}
.berita-content img {
    max-width: 100%;
    height: auto;
    border-radius: 12px;
}
.berita-content h1,
.berita-content h2,
.berita-content h3,
.berita-content h4,
.berita-content h5,
.berita-content h6 {
    color: #212529;
    font-weight: 700;
    margin-top: 1.5rem;
    margin-bottom: 1rem;
}
.berita-content ul,
.berita-content ol {
    padding-left: 1.5rem;
    margin-bottom: 1rem;
}
</style>
@endsection