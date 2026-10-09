@extends('layouts.admin')
@section('title', 'Tambah Prestasi')
@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <h3 class="mb-1">Tambah Prestasi</h3>
        <p class="text-muted mb-0">Tambahkan prestasi sekolah</p>
    </div>
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Data belum benar.</strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.prestasi.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="nama_prestasi" class="form-label">Nama Prestasi</label>
                    <input type="text" name="nama_prestasi" id="nama_prestasi" class="form-control @error('nama_prestasi') is-invalid @enderror" value="{{ old('nama_prestasi') }}" placeholder="Contoh: Juara 1 Lomba Futsal" maxlength="40" required>
                    @error('nama_prestasi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="5" placeholder="Masukkan deskripsi prestasi..." required>{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="foto" class="form-label">Foto Prestasi</label>
                    <input type="file" name="foto" id="foto" class="form-control @error('foto') is-invalid @enderror" accept=".jpg,.jpeg,.png" required>
                    <small class="text-muted">Format JPG/JPEG/PNG, maksimal 2 MB.</small>
                    @error('foto')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="tahun_ajaran" class="form-label">Tahun Ajaran</label>
                    <input type="number" name="tahun_ajaran" id="tahun_ajaran" class="form-control @error('tahun_ajaran') is-invalid @enderror" value="{{ old('tahun_ajaran') }}" placeholder="Contoh: 2026" min="2000" max="2100" required>
                    @error('tahun_ajaran')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <a href="{{ route('admin.prestasi.index') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-green">
                    <i class="bi bi-save me-1"></i>Simpan Data
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
