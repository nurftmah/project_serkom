@extends('layouts.admin')
@section('title', 'Tambah Ekstrakurikuler')
@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <h3 class="mb-1">Tambah Ekstrakurikuler</h3>
        <p class="text-muted mb-0">Tambahkan data ekstrakurikuler baru</p>
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
            <form action="{{ route('admin.ekstrakurikuler.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="nama_ekskul" class="form-label">Nama Ekstrakurikuler</label>
                    <input type="text" name="nama_ekskul" id="nama_ekskul" class="form-control @error('nama_ekskul') is-invalid @enderror" maxlength="40" value="{{ old('nama_ekskul') }}" placeholder="Contoh: Pramuka" required>
                    @error('nama_ekskul')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="id_guru" class="form-label">Pembina</label>
                    <select name="id_guru" id="id_guru" class="form-select @error('id_guru') is-invalid @enderror" required>
                        <option value="">Pilih Guru</option>
                        @foreach($gurus as $guru)
                            <option value="{{ $guru->id_guru }}" {{ old('id_guru') == $guru->id_guru ? 'selected' : '' }}>
                                {{ $guru->nama_guru }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_guru')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="jadwal_latihan" class="form-label">Jadwal Latihan</label>
                    <input type="text" name="jadwal_latihan" id="jadwal_latihan" class="form-control @error('jadwal_latihan') is-invalid @enderror" maxlength="40" value="{{ old('jadwal_latihan') }}" placeholder="Contoh: Sabtu, 08.00 - 10.00" required>
                    @error('jadwal_latihan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="5" placeholder="Masukkan deskripsi ekstrakurikuler" required>{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="gambar" class="form-label">Gambar</label>
                    <input type="file" name="gambar" id="gambar" class="form-control @error('gambar') is-invalid @enderror" accept=".jpg,.jpeg,.png,.jfif" required>
                    <small class="text-muted">Format JPG/JPEG/PNG/JFIF, maksimal 2 MB.</small>
                    @error('gambar')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mt-4">
                    <a href="{{ route('admin.ekstrakurikuler.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-green">
                        <i class="bi bi-save me-1"></i>Simpan Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
