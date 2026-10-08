@extends('layouts.admin')

@section('title', 'Edit Profil Sekolah')

@section('content')

<div class="container-fluid px-4 py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="h3 text-dark fw-bold mb-1">
                Edit Profil Sekolah
            </h2>

            <p class="text-muted small mb-0">
                Ubah informasi lengkap identitas sekolah.
            </p>

        </div>

        {{-- <a href="{{ route('admin.profil.index') }}"
           class="btn btn-outline-secondary px-4 py-2 rounded-pill">

            <i class="fas fa-arrow-left me-2"></i>

            Kembali

        </a> --}}

    </div>

    @if($errors->any())

        <div class="alert alert-danger shadow-sm border-0 mb-4">

            <i class="fas fa-exclamation-circle me-2"></i>

            Terjadi kesalahan pada form.

            <ul class="mb-0 mt-2">

                @foreach($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif

    <div class="card border-0 shadow-sm rounded-4">

        <div class="card-body p-4">

            <form action="{{ route('admin.profil.update', $profil->id_profil) }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf

                @method('PUT')

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="form-label fw-semibold">
                            Nama Sekolah
                        </label>

                        <input type="text"
                               name="nama_sekolah"
                               class="form-control rounded-3"
                               value="{{ old('nama_sekolah', $profil->nama_sekolah) }}"
                               maxlength="40"
                               required>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label fw-semibold">
                            NPSN
                        </label>

                        <input type="text"
                               name="npsn"
                               class="form-control rounded-3"
                               value="{{ old('npsn', $profil->npsn) }}"
                               maxlength="10"
                               required>

                    </div>

                </div>

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="form-label fw-semibold">
                            Kepala Sekolah
                        </label>

                        <input type="text"
                               name="kepala_sekolah"
                               class="form-control rounded-3"
                               value="{{ old('kepala_sekolah', $profil->kepala_sekolah) }}"
                               maxlength="40"
                               required>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label fw-semibold">
                            Tahun Berdiri
                        </label>

                        <input type="number"
                               name="tahun_berdiri"
                               class="form-control rounded-3"
                               value="{{ old('tahun_berdiri', $profil->tahun_berdiri) }}"
                               required>

                    </div>

                </div>

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="form-label fw-semibold">
                            Kontak / Telepon
                        </label>

                        <input type="text"
                               name="kontak"
                               class="form-control rounded-3"
                               value="{{ old('kontak', $profil->kontak) }}"
                               maxlength="15"
                               required>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label fw-semibold">
                            Alamat
                        </label>

                        <textarea name="alamat"
                                  class="form-control rounded-3"
                                  rows="2"
                                  required>{{ old('alamat', $profil->alamat) }}</textarea>

                    </div>

                </div>

                <div class="mb-3">

                    <label class="form-label fw-semibold">
                        Deskripsi Sekolah
                    </label>

                    <textarea name="deskripsi"
                              class="form-control rounded-3"
                              rows="4"
                              required>{{ old('deskripsi', $profil->deskripsi) }}</textarea>

                </div>

               <div class="mb-4">
                    <label class="form-label fw-semibold">
                        Visi
                    </label>

                    <textarea
                        name="visi"
                        class="form-control rounded-3"
                        rows="4"
                        required>{{ old('visi', $profil->visi) }}</textarea>

                </div>

                <div class="mb-4">

                    <label class="form-label fw-semibold">
                        Misi
                    </label>

                    <textarea
                        name="misi"
                        class="form-control rounded-3"
                        rows="6"
                        required>{{ old('misi', $profil->misi) }}</textarea>

                </div>

                <div class="row bg-light p-3 rounded-3 mx-0 mb-4">

                    <div class="col-md-6 mb-3 mb-md-0">

                        <label class="form-label fw-semibold">
                            Ganti Logo Sekolah
                        </label>

                        <input type="file"
                               name="logo"
                               class="form-control form-control-sm rounded-3 bg-white"
                               accept=".jpg,.jpeg,.png">

                        @if(!empty($profil->logo))

                            <small class="text-muted d-block mt-2">
                                Logo saat ini: {{ $profil->logo }}
                            </small>

                        @endif

                        <small class="text-muted">
                            Format JPG, JPEG, PNG. Maksimal 2MB.
                        </small>

                    </div>

                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Ganti Foto Kepala Sekolah
                        </label>

                        <input type="file"
                               name="foto"
                               class="form-control form-control-sm rounded-3 bg-white"
                               accept=".jpg,.jpeg,.png">

                        @if(!empty($profil->foto))

                            <small class="text-muted d-block mt-2">
                                Foto saat ini: {{ $profil->foto }}
                            </small>

                        @endif

                        <small class="text-muted">
                            Format JPG, JPEG, PNG. Maksimal 2MB.
                        </small>

                    </div>

                </div>

                <div class="d-flex justify-content-end gap-2">

                    <a href="{{ route('admin.profil.index') }}"
                       class="btn btn-light px-4 rounded-pill">

                        <i class="fas fa-arrow-left me-2"></i>

                        Batal

                    </a>

                    <button type="submit"
                            class="btn btn-green px-4 rounded-pill shadow-sm">

                        <i class="fas fa-save me-2"></i>

                        Simpan Perubahan

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection
