@extends('layouts.admin')
@section('title', 'Data Guru')
@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <h3 class="mb-1">Edit Data Guru</h3>
        <p class="text-muted">Ubah data guru</p>
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
            <form action="{{ route('admin.guru.update', ['id' => Crypt::encryptString((string) $guru->id_guru)]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label">Nama Guru</label>
                    <input type="text" name="nama_guru" class="form-control" value="{{ old('nama_guru', $guru->nama_guru) }}" placeholder="Masukkan nama guru" required>
                    @error('nama_guru')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">NIP</label>
                    <input type="text" name="nip" class="form-control" value="{{ old('nip', $guru->nip) }}" placeholder="Masukkan NIP" required>
                    @error('nip')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Mata Pelajaran</label>
                    <input type="text" name="mapel" class="form-control" value="{{ old('mapel', $guru->mapel) }}" placeholder="Contoh: Matematika" required>
                    @error('mapel')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Foto Saat Ini</label>
                    <br>
                    @if($guru->foto)
                        <img src="{{ asset('storage/guru/' . $guru->foto) }}" width="100" height="100" style="object-fit: cover; border-radius: 10px;" alt="Foto {{ $guru->nama_guru }}">
                    @else
                        <p class="text-muted">Belum ada foto</p>
                    @endif
                </div>
                <div class="mb-4">
                    <label class="form-label">Ganti Foto</label>
                    <input type="file" name="foto" class="form-control" accept=".jpg,.jpeg,.png">
                    <small class="text-muted">Format JPG, JPEG, PNG. Maksimal 2 MB. Kosongkan jika tidak ingin mengganti foto.</small>
                    @error('foto')
                        <small class="text-danger d-block">{{ $message }}</small>
                    @enderror
                </div>
                <div>
                    <a href="{{ route('admin.guru.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-green">
                        <i class="bi bi-save"></i>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
