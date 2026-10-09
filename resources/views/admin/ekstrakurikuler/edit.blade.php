@extends('layouts.admin')
@section('title', 'Edit Ekstrakurikuler')
@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <h3 class="mb-1">Edit Ekstrakurikuler</h3>
        <p class="text-muted mb-0">Perbarui data ekstrakurikuler</p>
    </div>
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show">
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
            <form action="{{ route('admin.ekstrakurikuler.update', ['id' => Crypt::encryptString((string) $ekstrakurikuler->id_ekskul)]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="nama_ekskul" class="form-label">Nama Ekstrakurikuler</label>
                    <input type="text" name="nama_ekskul" id="nama_ekskul" class="form-control" maxlength="40" value="{{ old('nama_ekskul', $ekstrakurikuler->nama_ekskul) }}" required>
                    @error('nama_ekskul')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="id_guru" class="form-label">Pembina</label>
                    <select name="id_guru" id="id_guru" class="form-select" required>
                        <option value="">Pilih Guru</option>
                        @foreach($gurus as $guru)
                            <option value="{{ $guru->id_guru }}" {{ old('id_guru', $ekstrakurikuler->id_guru) == $guru->id_guru ? 'selected' : '' }}>
                                {{ $guru->nama_guru }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_guru')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="jadwal_latihan" class="form-label">Jadwal Latihan</label>
                    <input type="text" name="jadwal_latihan" id="jadwal_latihan" class="form-control" maxlength="40" value="{{ old('jadwal_latihan', $ekstrakurikuler->jadwal_latihan) }}" required>
                    @error('jadwal_latihan')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" class="form-control" rows="5" required>{{ old('deskripsi', $ekstrakurikuler->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                @if($ekstrakurikuler->gambar)
                    <div class="mb-3">
                        <label class="form-label">Gambar Saat Ini</label>
                        <div>
                            <img src="{{ asset('storage/ekstrakurikuler/' . $ekstrakurikuler->gambar) }}" width="150" height="100" class="rounded" style="object-fit: cover;" alt="Gambar {{ $ekstrakurikuler->nama_ekskul }}">
                        </div>
                    </div>
                @endif
                <div class="mb-3">
                    <label for="gambar" class="form-label">Ganti Gambar</label>
                    <input type="file" name="gambar" id="gambar" class="form-control" accept=".jpg,.jpeg,.png,.jfif">
                    <small class="text-muted">Format JPG, JPEG, PNG, JFIF. Maksimal 2 MB. Kosongkan jika tidak ingin mengganti gambar.</small>
                    @error('gambar')
                        <small class="text-danger d-block">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mt-4">
                    <a href="{{ route('admin.ekstrakurikuler.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-green">
                        <i class="bi bi-save me-1"></i>Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
