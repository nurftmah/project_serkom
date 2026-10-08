@extends('layouts.landing')

@section('title', 'Pengumuman')

@section('content')
<section class="py-5 bg-light">
    <div class="container py-4">
        <div class="text-center mb-5">
            <span class="badge bg-gradient-sekolah text-white rounded-pill px-3 py-2 mb-3">
                <i class="bi bi-megaphone-fill me-1"></i>
                Pengumuman
            </span>
            <h2 class="fw-bold text-dark mb-2">Pengumuman Sekolah</h2>
            <p class="text-muted mb-0">Informasi dan pengumuman terbaru dari MTS AL-AZHAR</p>
        </div>

        <div class="row g-3 align-items-stretch">
            @forelse($pengumumen->take(3) as $pengumuman)
                <div class="col-md-4 d-flex" data-aos="fade-up" data-aos-delay="{{ $loop->index * 150 }}">
                    <a href="{{ route('landing.pengumuman.show', ['id' => Crypt::encryptString((string) $pengumuman->id_pengumuman)]) }}" class="text-decoration-none d-flex w-100">
                        <div class="card rounded-4 shadow-sm overflow-hidden border-0 w-100 d-flex flex-column">
                            <div class="pengumuman-header bg-gradient-sekolah">
                                <div class="d-flex align-items-center">
                                    <div class="bg-white rounded-3 p-3 me-3">
                                        <i class="bi bi-megaphone-fill text-gradient-sekolah fs-3"></i>
                                    </div>
                                    <div>
                                        <small class="text-white opacity-75 d-block">
                                            <i class="bi bi-calendar3 me-1"></i>
                                            {{ \Carbon\Carbon::parse($pengumuman->tanggal)->format('d F Y') }}
                                        </small>
                                        <h6 class="fw-bold text-white mb-0 mt-1">Pengumuman</h6>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body p-4 d-flex flex-column">
                                <h5 class="fw-bold text-dark mb-3">{{ $pengumuman->judul }}</h5>
                                <p class="text-muted mb-4">
                                    {{ \Illuminate\Support\Str::limit(strip_tags($pengumuman->isi), 120) }}
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center rounded-4">
                        <i class="bi bi-info-circle me-2"></i>
                        Belum ada pengumuman.
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