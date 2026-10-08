@extends('layouts.admin')

@section('title', 'Profil Sekolah')

@section('content')

<div class="container-fluid px-4 py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="h3 text-dark fw-bold mb-1">
                Profil Sekolah
            </h2>

            <p class="text-muted small mb-0">
                Lihat informasi lengkap identitas sekolah.
            </p>
        </div>

        <a href="{{ route('admin.profil.edit', $profil->id_profil) }}"
           class="btn btn-green px-4 py-2 rounded-pill shadow-sm fw-semibold">

            <i class="fas fa-edit me-2"></i>
            Edit Profil Sekolah

        </a>

    </div>

    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show shadow-sm border-0 mb-4"
             role="alert">

            <i class="fas fa-check-circle me-2"></i>

            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>

        </div>

    @endif

    @if(session('error'))

        <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0 mb-4"
             role="alert">

            <i class="fas fa-exclamation-circle me-2"></i>

            {{ session('error') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>

        </div>

    @endif

    <div class="row g-4">

        <div class="col-lg-4">

            <div class="card border-0 shadow-sm rounded-4 overflow-hidden text-center p-4">

                <div class="mb-3">

                    @if(!empty($profil->logo))

                        <img src="{{ asset('uploads/profil/' . $profil->logo) }}"
                             alt="Logo Sekolah"
                             class="rounded-circle shadow-sm border p-1"
                             width="100"
                             height="100"
                             style="object-fit: cover;">

                    @else

                        <div class="rounded-circle bg-light d-flex align-items-center justify-content-center mx-auto"
                             style="width:100px;height:100px;">

                            <i class="fas fa-school text-muted fs-2"></i>

                        </div>

                    @endif

                </div>

                <h5 class="fw-bold mb-1 text-dark">

                    {{ $profil->nama_sekolah ?: 'Nama Sekolah Belum Diatur' }}

                </h5>

                <span class="badge px-3 py-2 rounded-pill small fw-semibold mb-3"
                    style="background-color: #dff5f8; color: #159bb0;">
                    NPSN: {{ $profil->npsn ?: '-' }}
                </span>

                <hr class="text-muted opacity-25">

                <div class="mb-3">

                    <span class="d-block text-muted small fw-bold text-uppercase mb-2">

                        Kepala Sekolah

                    </span>

                    @if(!empty($profil->foto))

                        <img src="{{ asset('uploads/profil/' . $profil->foto) }}"
                             alt="Foto Kepala Sekolah"
                             class="rounded-3 shadow-sm mb-2"
                             width="110"
                             height="130"
                             style="object-fit: cover;">

                    @else

                        <div class="rounded-3 bg-light d-flex align-items-center justify-content-center mx-auto mb-2"
                             style="width:110px;height:130px;">

                            <i class="fas fa-user-tie text-muted fs-2"></i>

                        </div>

                    @endif

                    <h6 class="fw-bold text-dark mb-0">

                        {{ $profil->kepala_sekolah ?: '-' }}

                    </h6>

                </div>

                <div class="text-start small mt-4">

                    <div class="mb-3">

                        <strong>Kontak:</strong>

                        <br>

                        <span class="text-muted">
                            {{ $profil->kontak ?: '-' }}
                        </span>

                    </div>

                    <div class="mb-3">

                        <strong>Tahun Berdiri:</strong>

                        <br>

                        <span class="text-muted">
                            {{ $profil->tahun_berdiri ?: '-' }}
                        </span>

                    </div>

                    <div>

                        <strong>Alamat:</strong>

                        <br>

                        <span class="text-muted">
                            {{ $profil->alamat ?: '-' }}
                        </span>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-lg-8">

            <div class="card border-0 shadow-sm rounded-4 mb-4">

                <div class="card-body p-4">

                    <h5 class="fw-bold text-dark mb-3">

                        <i class="fas fa-info-circle text-primary me-2"></i>

                        Tentang Sekolah

                    </h5>

                    <p class="text-muted"
                       style="line-height: 1.7;">

                        {{ $profil->deskripsi ?: 'Belum ada deskripsi sekolah yang diatur.' }}

                    </p>

                </div>

            </div>

           <div class="card border-0 shadow-sm rounded-4 mb-4">

                <div class="card-body p-4">

                    <h5 class="fw-bold text-dark mb-3">
                        <i class="fas fa-eye text-primary me-2"></i>
                        Visi
                    </h5>

                    <div class="p-3 bg-light rounded-3 text-muted"
                        style="line-height: 1.7;">

                        {{ $profil->visi ?: 'Belum ada visi yang diatur.' }}

                    </div>

                </div>

            </div>

            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-body p-4">

                    <h5 class="fw-bold text-dark mb-3">
                        <i class="fas fa-bullseye text-primary me-2"></i>
                        Misi
                    </h5>

                    <div class="p-3 bg-light rounded-3 text-muted"
                        style="white-space: pre-line; line-height: 1.7;">

                        {{ $profil->misi ?: 'Belum ada misi yang diatur.' }}

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
