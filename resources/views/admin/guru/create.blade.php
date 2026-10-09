@extends('layouts.admin')
@section('title', 'Tambah Guru')
@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <h3 class="mb-1">Tambah Guru</h3>
        <p class="text-muted">Tambahkan data guru baru</p>
    </div>
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.guru.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Nama Guru</label>
                    <input type="text" name="nama_guru" class="form-control" value="{{ old('nama_guru') }}" placeholder="Masukkan nama guru" required>
                    @error('nama_guru')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">NIP</label>
                    <input type="text" name="nip" class="form-control" value="{{ old('nip') }}" placeholder="Masukkan NIP" required>
                    @error('nip')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Mata Pelajaran</label>
                    <input type="text" name="mapel" class="form-control" value="{{ old('mapel') }}" placeholder="Contoh: Matematika" required>
                    @error('mapel')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="form-label">Foto Guru</label>
                    <input type="file" name="foto" class="form-control" accept=".jpg,.jpeg,.png">
                    <small class="text-muted">Format JPG, JPEG, PNG. Maksimal 2 MB.</small>
                    @error('foto')
                        <small class="text-danger d-block">{{ $message }}</small>
                    @enderror
                </div>
                <div>
                    <a href="{{ route('admin.guru.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-green">
                        <i class="bi bi-save"></i> Simpan Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
