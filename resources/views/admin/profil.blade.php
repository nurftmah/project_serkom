@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4 py-4">
    <!-- Header Title & Tombol Edit -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="h3 text-dark fw-bold mb-1">Profil Sekolah</h2>
            <p class="text-muted small mb-0">Kelola dan lihat informasi lengkap identitas sekolah.</p>
        </div>
        <!-- Tombol untuk memunculkan Modal Edit -->
        <button type="button" class="btn btn-primary px-4 py-2 rounded-pill shadow-sm fw-semibold" data-bs-toggle="modal" data-bs-target="#editProfilModal">
            <i class="fas fa-edit me-2"></i> Edit Profil Sekolah
        </button>
    </div>

    {{-- Notifikasi Sukses --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm border-0 mb-4" role="alert">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Notifikasi Error Validasi --}}
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0 mb-4" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i> Terjadi kesalahan input pada form edit. Silakan cek kembali.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row g-4">
        <!-- Kolom Kiri: Ringkasan Logo & Kepala Sekolah -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden text-center p-4">
                <div class="mb-3">
                    @if(!empty($profil->logo))
                        <img src="{{ asset('uploads/profil/' . $profil->logo) }}" alt="Logo Sekolah" class="rounded-circle shadow-sm border p-1" width="100" height="100" style="object-fit: cover;">
                    @else
                        <img src="https://via.placeholder.com/100" alt="Logo Sekolah" class="rounded-circle shadow-sm border p-1" width="100" height="100" style="object-fit: cover;">
                    @endif
                </div>

                <h5 class="fw-bold mb-1 text-dark">{{ $profil->nama_sekolah ?: 'Nama Sekolah Belum Diatur' }}</h5>
                <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-1 rounded-pill small fw-semibold mb-3">NPSN: {{ $profil->npsn ?: '-' }}</span>

                <hr class="text-muted opacity-25">

                <div class="mb-3">
                    <span class="d-block text-muted small fw-bold text-uppercase mb-2">Kepala Sekolah</span>
                    @if(!empty($profil->foto))
                        <img src="{{ asset('uploads/profil/' . $profil->foto) }}" alt="Foto Kepala Sekolah" class="rounded-3 shadow-sm mb-2" width="110" height="130" style="object-fit: cover;">
                    @else
                        <img src="https://via.placeholder.com/110x130" alt="Foto Kepala Sekolah" class="rounded-3 shadow-sm mb-2" width="110" height="130" style="object-fit: cover;">
                    @endif
                    <h6 class="fw-bold text-dark mb-0">{{ $profil->kepala_sekolah ?: '-' }}</h6>
                </div>

                <div class="text-start small mt-4">
                    <div class="mb-2"><strong>Kontak:</strong> <br><span class="text-muted">{{ $profil->kontak ?: '-' }}</span></div>
                    <div class="mb-2"><strong>Tahun Berdiri:</strong> <br><span class="text-muted">{{ $profil->tahun_berdiri ?: '-' }}</span></div>
                    <div><strong>Alamat:</strong> <br><span class="text-muted">{{ $profil->alamat ?: '-' }}</span></div>
                </div>
            </div>
        </div>

        <!-- Kolom Kanan: Detail Deskripsi & Visi Misi -->
        <div class="col-lg-8">
            <!-- Card Tentang Sekolah -->
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold text-dark mb-3"><i class="fas fa-info-circle text-primary me-2"></i> Tentang Sekolah</h5>
                    <p class="text-muted text-justify" style="line-height: 1.7;">
                        {{ $profil->deskripsi ?: 'Belum ada deskripsi sekolah yang diatur.' }}
                    </p>
                </div>
            </div>

            <!-- Card Visi & Misi -->
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold text-dark mb-3"><i class="fas fa-bullseye text-primary me-2"></i> Visi & Misi</h5>
                    <div class="p-3 bg-light rounded-3 text-muted" style="white-space: pre-line; line-height: 1.7;">
                        {{ $profil->visi_misi ?: 'Belum ada visi & misi yang diatur.' }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ================= MODAL FORM EDIT PROFIL ================= -->
<div class="modal fade" id="editProfilModal" tabindex="-1" aria-labelledby="editProfilModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow rounded-4">
            <div class="modal-header bg-primary text-white px-4 py-3">
                <h5 class="modal-title fw-bold" id="editProfilModalLabel"><i class="fas fa-edit me-2"></i> Edit Profil Sekolah</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ route('admin.profil.update', $profil->id_profil ?? 0) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="modal-body p-4">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold small text-muted">Nama Sekolah</label>
                            <input type="text" name="nama_sekolah" class="form-control rounded-3" value="{{ old('nama_sekolah', $profil->nama_sekolah) }}" required maxlength="40">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold small text-muted">NPSN</label>
                            <input type="text" name="npsn" class="form-control rounded-3" value="{{ old('npsn', $profil->npsn) }}" required maxlength="10">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold small text-muted">Kepala Sekolah</label>
                            <input type="text" name="kepala_sekolah" class="form-control rounded-3" value="{{ old('kepala_sekolah', $profil->kepala_sekolah) }}" required maxlength="40">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold small text-muted">Tahun Berdiri</label>
                            <input type="number" name="tahun_berdiri" class="form-control rounded-3" value="{{ old('tahun_berdiri', $profil->tahun_berdiri) }}" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold small text-muted">Kontak / Telepon</label>
                            <input type="text" name="kontak" class="form-control rounded-3" value="{{ old('kontak', $profil->kontak) }}" required maxlength="15">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold small text-muted">Alamat</label>
                            <textarea name="alamat" class="form-control rounded-3" rows="2" required>{{ old('alamat', $profil->alamat) }}</textarea>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-muted">Deskripsi Sekolah</label>
                        <textarea name="deskripsi" class="form-control rounded-3" rows="3" required>{{ old('deskripsi', $profil->deskripsi) }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-muted">Visi & Misi</label>
                        <textarea name="visi_misi" class="form-control rounded-3" rows="4" required>{{ old('visi_misi', $profil->visi_misi) }}</textarea>
                    </div>

                    <div class="row bg-light p-3 rounded-3 mx-0">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label class="form-label fw-semibold small text-dark">Ganti Logo Sekolah</label>
                            <input type="file" name="logo" class="form-control form-control-sm rounded-3 bg-white">
                            <small class="text-muted" style="font-size: 11px;">Format: JPG, PNG (Maks. 2MB)</small>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small text-dark">Ganti Foto Kepala Sekolah</label>
                            <input type="file" name="foto" class="form-control form-control-sm rounded-3 bg-white">
                            <small class="text-muted" style="font-size: 11px;">Format: JPG, PNG (Maks. 2MB)</small>
                        </div>
                    </div>
                </div>

                <div class="modal-footer px-4 py-3 bg-light">
                    <button type="button" class="btn btn-secondary px-4 rounded-pill" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary px-4 rounded-pill shadow-sm">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Script untuk memunculkan kembali modal jika ada error validasi saat submit --}}
@if ($errors->any())
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var myModal = new bootstrap.Modal(document.getElementById('editProfilModal'));
        myModal.show();
    });
</script>
@endif
@endsection
