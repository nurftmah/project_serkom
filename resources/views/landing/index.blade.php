@extends('layouts.landing')
@section('title', 'Beranda')
@section('content')

{{-- BERANDA --}}
<section id="beranda" class="position-relative">
    @php
        $fotoGaleri = $galeris->where('kategori', 'Foto')->filter(function ($galeri) {
            return !empty($galeri->file)
                && file_exists(storage_path('app/public/galeri/' . $galeri->file));
        })->values();
    @endphp

    <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
        @if($fotoGaleri->count() > 1)
            <div class="carousel-indicators">
                @foreach($fotoGaleri as $galeri)
                    <button
                        type="button"
                        data-bs-target="#heroCarousel"
                        data-bs-slide-to="{{ $loop->index }}"
                        class="{{ $loop->first ? 'active' : '' }}"
                        aria-label="Slide {{ $loop->iteration }}"
                        {{ $loop->first ? 'aria-current=true' : '' }}>
                    </button>
                @endforeach
            </div>
        @endif

        <div class="carousel-inner">
            @forelse($fotoGaleri as $galeri)
                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                    <img
                        src="{{ asset('storage/galeri/' . $galeri->file) }}"
                        class="d-block w-100"
                        style="height: 550px; object-fit: cover;"
                        alt="{{ $galeri->judul }}">

                    <div
                        class="position-absolute top-0 start-0 w-100 h-100"
                        style="background: rgba(0, 0, 0, 0.45);">
                    </div>

                    <div class="carousel-caption text-start h-100 d-flex align-items-center">
                        <div class="container">
                            <div class="col-lg-7" data-aos="zoom-in-down">
                                <span class="badge bg-gradient-sekolah text-white px-3 py-2 mb-3">
                                    Visi &amp; Misi
                                </span>

                                <h1 class="fs-2 fw-bold mb-3">
                                    {{ $profil?->visi ?? 'Visi MTS AL-AZHAR' }}
                                </h1>

                                <p class="fs-6 mb-4">
                                    {{ $profil?->misi ?? 'Misi MTS AL-AZHAR' }}
                                </p>

                                <div class="d-flex gap-2 flex-wrap">
                                    <a href="#tentang" class="btn btn-light text-success px-4 py-2">
                                        <i class="bi bi-building me-2"></i>Tentang Sekolah
                                    </a>
                                    <a href="#berita" class="btn btn-outline-light px-4 py-2">
                                        <i class="bi bi-newspaper me-2"></i>Berita
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="carousel-item active">
                    <div class="d-flex align-items-center justify-content-center bg-secondary text-white" style="height: 550px;">
                        <h4>Belum ada foto galeri.</h4>
                    </div>
                </div>
            @endforelse
        </div>

        @if($fotoGaleri->count() > 1)
            <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Sebelumnya</span>
            </button>

            <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Berikutnya</span>
            </button>
        @endif
    </div>
</section>


{{-- JUMLAH --}}
<section class="position-relative" style="margin-top: -50px; z-index: 10;">
    <div class="container-fluid px-0">
        <div class="bg rounded-4 shadow mx-auto overflow-hidden" style="width: 88%;">
            <div class="row g-0">
                <div class="col-6 col-md-3 position-relative" data-aos="fade-up-left">
                    <div class="text-center text-white py-4 px-3">
                        <h2 class="fw-bold mb-1">{{ $jumlahSiswa }}</h2>
                        <p class="mb-0">Siswa</p>
                    </div>
                    <div class="position-absolute top-0 end-0 bg-dark opacity-25" style="width: 28px; height: 120%; transform: skewX(-18deg);"></div>
                </div>
                <div class="col-6 col-md-3 position-relative" data-aos="fade-up-right">
                    <div class="text-center text-white py-4 px-3">
                        <h2 class="fw-bold mb-1">{{ $jumlahGuru }}</h2>
                        <p class="mb-0">Guru & Staf</p>
                    </div>
                    <div class="position-absolute top-0 end-0 bg-dark opacity-25" style="width: 28px; height: 120%; transform: skewX(-18deg);"></div>
                </div>
                <div class="col-6 col-md-3" data-aos="fade-up-left">
                    <div class="text-center text-white py-4 px-3">
                        <h2 class="fw-bold mb-1">{{ $jumlahPrestasi }}</h2>
                        <p class="mb-0">Prestasi</p>
                    </div>
                    <div class="position-absolute top-0 end-0 bg-dark opacity-25" style="width: 28px; height: 120%; transform: skewX(-18deg);"></div>
                </div>
                <div class="col-6 col-md-3" data-aos="fade-up-right">
                    <div class="text-center text-white py-4 px-3">
                        <h2 class="fw-bold mb-1">{{ $jumlahEkstrakurikuler }}</h2>
                        <p class="mb-0">Ekstrakurikuler</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- SAMBUTAN --}}
<section id="tentang" class="py-5 bg-white">
    <div class="container py-5">
        <div class="row align-items-center g-5" data-aos="fade-up" data-aos-duration="3000">
            <div class="col-lg-5">
                @if($profils && $profils->foto)
                    <div class="ratio ratio-4x3 rounded-4 overflow-hidden shadow-sm">
                        <img src="{{ asset('storage/profil/' . $profils->foto) }}" alt="{{ $profils->kepala_sekolah ?? 'Kepala Sekolah' }}" class="w-100 h-100 object-fit-cover">
                    </div>
                @else
                    <div class="ratio ratio-4x3 bg-light rounded-4 d-flex align-items-center justify-content-center shadow-sm">
                        <i class="bi bi-person-fill text-secondary display-1"></i>
                    </div>
                @endif
            </div>
            <div class="col-lg-7">
                <span class="badge bg-gradient-sekolah text-white rounded-pill px-3 py-2 mb-3">
                    <i class="bi bi-chat-quote-fill me-1"></i>Tentang Sekolah
                </span>
                <h2 class="fw-bold text-dark mb-4">Sambutan Kepala Sekolah</h2>
                <div class="text-muted lh-lg fs-6 mb-4">
                    @if($profils && $profils->sambutan)
                        {!! nl2br(e($profils->sambutan)) !!}
                    @else
                        <p class="mb-3">Assalamu’alaikum warahmatullahi wabarakatuh.</p>
                        <p class="mb-3">Puji syukur kita panjatkan ke hadirat Allah SWT atas segala rahmat dan karunia-Nya. Selamat datang di website resmi MTs Al-Azhar.</p>
                        <p class="mb-3">Website ini dikembangkan sebagai sarana informasi dan komunikasi bagi sekolah, siswa, orang tua, serta masyarakat luas guna mengenal lebih dekat profil, kegiatan, dan prestasi sekolah kami.</p>
                        <p class="mb-3">Kami berkomitmen untuk terus meningkatkan mutu pendidikan serta membentuk generasi yang berakhlak mulia, berilmu, dan berprestasi.</p>
                        <p class="mb-0">Wassalamu’alaikum warahmatullahi wabarakatuh.</p>
                    @endif
                </div>
                <div class="bg-gradient-sekolah rounded-pill mb-3" style="width: 65px; height: 5px;"></div>
                <h5 class="fw-bold text-dark mb-1">{{ $profils->kepala_sekolah ?? 'Belum tersedia' }}</h5>
                <p class="text-gradient-sekolah fw-semibold mb-0">KEPALA SEKOLAH {{ strtoupper($profils->nama_sekolah ?? 'MTS AL-AZHAR') }}</p>
            </div>
        </div>
        <div class="text-center mt-5 pt-4" data-aos="zoom-in">
            <h4 class="fw-bold text-dark mb-2">Ingin Mengenal Sekolah Kami Lebih Dekat?</h4>
            <p class="text-muted mb-3">Lihat informasi lengkap mengenai profil, visi, misi, dan fasilitas sekolah.</p>
            <a href="{{ route('landing.tentang') }}" class="btn btn-outline-success rounded-3 px-4 py-2">
                Lihat Tentang Sekolah <i class="bi bi-arrow-right ms-1"></i>
            </a>
        </div>
    </div>
</section>

{{-- GURU --}}
<section class="py-5 bg-light" id="guru">
    <div class="container py-4">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4" data-aos="fade-down">
            <div>
                <h2 class="fw-bold text mt-2 mb-1">
                    <i class="bi bi-person-workspace"></i>
                    Guru dan Tenaga Pendidik
                </h2>
                <p class="text-muted mb-0">Kenali pendidik yang mendampingi proses belajar siswa setiap hari.</p>
            </div>
            <div class="d-flex align-items-center gap-2">
                <a href="{{ route('landing.guru') }}" class="btn btn-outline-success rounded-3 px-4">
                    Lihat semua guru <i class="bi bi-arrow-right ms-1"></i>
                </a>
                @if($gurus->count() > 3)
                    <button class="btn btn-light border rounded-circle" type="button" data-bs-target="#guruCarousel" data-bs-slide="prev">
                        <i class="bi bi-chevron-left"></i>
                    </button>
                    <button class="btn btn-light border rounded-circle" type="button" data-bs-target="#guruCarousel" data-bs-slide="next">
                        <i class="bi bi-chevron-right"></i>
                    </button>
                @endif
            </div>
        </div>
        @if($gurus->count())
            <div id="guruCarousel" class="carousel slide">
                <div class="carousel-inner">
                    @foreach($gurus->chunk(3) as $index => $guruChunk)
                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                            <div class="row g-4">
                                @foreach($guruChunk as $guru)
                                    <div class="col-md-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 150 }}">
                                        <a href="{{ route('landing.guru.show', ['id' => \Illuminate\Support\Facades\Crypt::encryptString((string) $guru->id_guru)]) }}" class="text-decoration-none">
                                            <div class="card border rounded-4 shadow-sm overflow-hidden h-100">
                                                <div class="bg-gradient-sekolah text-center p-4">
                                                    @if($guru->foto)
                                                        <img src="{{ asset('storage/guru/' . $guru->foto) }}" alt="{{ $guru->nama_guru }}" class="foto-guru rounded-4 border border-4 border-white shadow">
                                                    @else
                                                        <div class="foto-guru bg-white rounded-4 d-inline-flex align-items-center justify-content-center border border-4 border-white shadow">
                                                            <i class="bi bi-person-fill text-secondary display-4"></i>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="card-body p-4">
                                                    <h5 class="fw-bold text-dark mb-1">{{ $guru->nama_guru }}</h5>
                                                    <p class="fw-semibold text-gradient-sekolah mb-3">Guru Mata Pelajaran</p>
                                                    <div class="border-top pt-3">
                                                        <small class="text">
                                                            <i class="bi bi-book me-1 text"></i>
                                                            {{ $guru->mapel ?: 'Belum tersedia' }}
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <div class="alert alert-info text-center rounded-4">
                <i class="bi bi-info-circle me-2"></i>Belum ada data guru.
            </div>
        @endif
    </div>
</section>

{{-- BERITA --}}
<section id="berita" class="py-5 bg-white">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3" data-aos="fade-down">
            <div>
                <h2 class="fw-bold mb-1 text">
                    <i class="bi bi-newspaper me-2"></i>Berita Terbaru
                </h2>
                <p class="text-muted mb-0">Sorotan berita terbaru dari MTS AL-AZHAR</p>
            </div>
            <a href="{{ route('landing.berita') }}" class="btn btn-outline-success rounded-3">
                Lihat semua berita <i class="bi bi-arrow-right ms-1"></i>
            </a>
        </div>
        <hr>
        <div class="row g-4">
            @forelse($beritas as $berita)
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 150 }}">
                    <a href="{{ route('landing.berita.show', ['slug' => $berita->slug]) }}" class="text-decoration-none d-block h-100">
                        <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100 berita-card">
                            @if($berita->gambar)
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
                                <p class="text-muted mb-0">{{ \Illuminate\Support\Str::limit(strip_tags($berita->isi), 120) }}</p>
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
    </div>
</section>

{{-- PENGUMUMAN --}}
<section id="pengumuman" class="py-5 bg-light">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3" data-aos="fade-down">
            <div>
                <h2 class="fw-bold mb-1 text">
                    <i class="bi bi-megaphone-fill me-2"></i>Pengumuman Terbaru
                </h2>
                <p class="text-muted mb-0">Informasi dan pengumuman terbaru dari MTS AL-AZHAR</p>
            </div>
            <a href="{{ route('landing.pengumuman') }}" class="btn btn-outline-success rounded-3">
                Lihat semua pengumuman <i class="bi bi-arrow-right ms-1"></i>
            </a>
        </div>
        <hr>
        <div class="row g-3 align-items-stretch">
            @forelse($pengumumen->take(3) as $pengumuman)
                <div class="col-md-4 d-flex" data-aos="fade-up" data-aos-delay="{{ $loop->index * 150 }}">
                    <a href="{{ route('landing.pengumuman.show', ['id' => Crypt::encryptString((string) $pengumuman->id_pengumuman)]) }}" class="text-decoration-none d-flex w-100">
                        <div class="card rounded-4 shadow-sm overflow-hidden border-0 w-100 d-flex flex-column pengumuman-card">
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
                                <p class="text-muted mb-4">{{ \Illuminate\Support\Str::limit(strip_tags($pengumuman->isi), 120) }}</p>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center rounded-4">
                        <i class="bi bi-info-circle me-2"></i>Belum ada pengumuman.
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</section>

{{-- EKSTRAKURIKULER --}}
<section id="ekstrakurikuler" class="py-5 bg-white">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3" data-aos="fade-down">
            <div>
                <h2 class="fw-bold mb-1 text">
                    <i class="bi bi-stars me-2"></i>Ekstrakurikuler Sekolah
                </h2>
                <p class="text-muted mb-0">Berbagai kegiatan untuk mengembangkan bakat dan minat siswa</p>
            </div>
            <a href="{{ route('landing.ekstrakurikuler') }}" class="btn btn-outline-success rounded-3">
                Lihat semua ekskul <i class="bi bi-arrow-right ms-1"></i>
            </a>
        </div>
        <hr>
        <div class="row g-3" data-aos="fade-up">
            @forelse($ekstrakurikulers->take(3) as $ekskul)
                <div class="col-md-4">
                    <a href="{{ route('landing.ekstrakurikuler.show', ['slug' => $ekskul->slug]) }}" class="text-decoration-none d-block">
                        <div class="card h-100 rounded-4 shadow-sm overflow-hidden ekskul-card">
                            @if($ekskul->gambar)
                                <div class="ratio ratio-16x9">
                                    <img src="{{ asset('storage/ekstrakurikuler/' . $ekskul->gambar) }}" alt="{{ $ekskul->nama_ekskul }}" class="object-fit-cover">
                                </div>
                            @else
                                <div class="ratio ratio-16x9 bg-light d-flex justify-content-center align-items-center">
                                    <i class="bi bi-stars text-success display-3"></i>
                                </div>
                            @endif
                            <div class="card-body p-4">
                                <h5 class="fw-bold text-dark mb-3">{{ $ekskul->nama_ekskul }}</h5>
                                <div class="mb-2">
                                    <small class="text-muted"><i class="bi bi-person-fill me-1"></i>Pembina</small>
                                    <p class="mb-0 text-dark">{{ $ekskul->pembina }}</p>
                                </div>
                                <div class="mb-3">
                                    <small class="text-muted"><i class="bi bi-calendar3 me-1"></i>Jadwal Latihan</small>
                                    <p class="mb-0 text-dark">{{ $ekskul->jadwal_latihan }}</p>
                                </div>
                                <p class="text-muted mb-0">{{ \Illuminate\Support\Str::limit($ekskul->deskripsi, 100) }}</p>
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
    </div>
</section>

{{-- PRESTASI --}}
<section class="py-5 bg-light" id="prestasi">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3" data-aos="fade-down">
            <div>
                <h2 class="fw-bold mb-1 text">
                    <i class="bi bi-trophy-fill me-2"></i>Prestasi Sekolah
                </h2>
                <p class="text-muted mb-0">Prestasi yang telah diraih oleh siswa-siswi MTS AL-AZHAR</p>
            </div>
            <a href="{{ route('landing.prestasi') }}" class="btn btn-outline-success rounded-3">
                Lihat semua prestasi <i class="bi bi-arrow-right ms-1"></i>
            </a>
        </div>
        <hr>
        <div class="row g-3" data-aos="fade-up">
            @forelse($prestasis->take(3) as $prestasi)
                <div class="col-md-4">
                    <a href="{{ route('landing.prestasi.show', ['slug' => $prestasi->slug]) }}" class="text-decoration-none d-block">
                        <div class="card h-100 rounded-4 shadow-sm overflow-hidden prestasi-card">
                            @if($prestasi->foto)
                                <div class="ratio ratio-16x9">
                                    <img src="{{ asset('storage/prestasi/' . $prestasi->foto) }}" alt="{{ $prestasi->nama_prestasi }}" class="object-fit-cover">
                                </div>
                            @else
                                <div class="ratio ratio-16x9 bg-light d-flex justify-content-center align-items-center">
                                    <i class="bi bi-trophy-fill text-secondary display-3"></i>
                                </div>
                            @endif
                            <div class="card-body p-4">
                                <span class="badge bg-gradient-sekolah text-white rounded-pill mb-3">{{ $prestasi->tahun_ajaran }}</span>
                                <h5 class="fw-bold text-dark mb-2">{{ $prestasi->nama_prestasi }}</h5>
                                <p class="text-muted mb-0">{{ \Illuminate\Support\Str::limit($prestasi->deskripsi, 100) }}</p>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center rounded-4">Belum ada data prestasi.</div>
                </div>
            @endforelse
        </div>
    </div>
</section>

{{-- GALERI --}}
<section id="galeri" class="py-5 bg-white">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3" data-aos="fade-down">
            <div>
                <h2 class="fw-bold mb-1 text">
                    <i class="bi bi-images me-2"></i>Galeri Sekolah
                </h2>
                <p class="text-muted mb-0">Dokumentasi kegiatan dan aktivitas MTS AL-AZHAR</p>
            </div>
            <a href="{{ route('landing.galeri') }}" class="btn btn-outline-success rounded-3">
                Lihat semua galeri <i class="bi bi-arrow-right ms-1"></i>
            </a>
        </div>
        <hr>
        <div class="row g-3 align-items-stretch" data-aos="fade-up">
            @forelse($galeris->take(3) as $galeri)
                <div class="col-md-4 d-flex">
                    <a href="{{ route('landing.galeri.show', ['id' => Crypt::encryptString((string) $galeri->id_galeri)]) }}" class="text-decoration-none d-flex w-100">
                        <div class="card border-0 shadow-sm rounded-4 overflow-hidden w-100 galeri-card">
                            @if($galeri->file && file_exists(storage_path('app/public/galeri/' . $galeri->file)))
                                <div class="ratio ratio-16x9">
                                    @if(strtolower($galeri->kategori) === 'video')
                                        <video class="w-100 h-100" controls>
                                            <source src="{{ asset('storage/galeri/' . $galeri->file) }}">
                                            Browser kamu tidak mendukung video.
                                        </video>
                                    @else
                                        <img src="{{ asset('storage/galeri/' . $galeri->file) }}" alt="{{ $galeri->judul }}" class="w-100 h-100 object-fit-cover">
                                    @endif
                                </div>
                            @else
                                <div class="ratio ratio-16x9 bg-gradient-sekolah d-flex align-items-center justify-content-center">
                                    <i class="bi bi-images text-white display-4"></i>
                                </div>
                            @endif
                            <div class="card-body p-4 d-flex flex-column">
                                <div class="d-flex justify-content-between align-items-center mb-3 gap-2">
                                    <span class="badge bg-gradient-sekolah rounded-pill px-3 py-2">
                                        <i class="bi bi-camera-fill me-1"></i>{{ $galeri->kategori }}
                                    </span>
                                    <small class="text-success text-nowrap">
                                        <i class="bi bi-calendar3 me-1"></i>
                                        {{ $galeri->tanggal ? \Carbon\Carbon::parse($galeri->tanggal)->format('d M Y') : '-' }}
                                    </small>
                                </div>
                                <h5 class="fw-bold text-dark mb-2">{{ $galeri->judul }}</h5>
                                <p class="text-muted mb-0">{{ \Illuminate\Support\Str::limit($galeri->keterangan, 100) }}</p>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center rounded-4 border-0 shadow-sm py-4">
                        <i class="bi bi-images me-2"></i>Belum ada dokumentasi kegiatan sekolah.
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</section>
@endsection
