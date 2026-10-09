@extends('layouts.admin')
@section('title', 'Edit Galeri')
@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <h3>Edit Galeri</h3>
        <p class="text-muted">Ubah data galeri sekolah</p>
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
            <form action="{{ route('admin.galeri.update', ['id' => Crypt::encryptString((string) $galeri->id_galeri)]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label">Judul</label>
                    <input type="text" name="judul" class="form-control" value="{{ old('judul', $galeri->judul) }}" required>
                    @error('judul')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Keterangan</label>
                    <textarea name="keterangan" class="form-control" rows="4" required>{{ old('keterangan', $galeri->keterangan) }}</textarea>
                    @error('keterangan')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Kategori</label>
                    <select name="kategori" class="form-select" required>
                        <option value="Foto" {{ old('kategori', $galeri->kategori) == 'Foto' ? 'selected' : '' }}>Foto</option>
                        <option value="Video" {{ old('kategori', $galeri->kategori) == 'Video' ? 'selected' : '' }}>Video</option>
                    </select>
                    @error('kategori')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">File Saat Ini</label>
                    <br>
                    @if($galeri->file)
                        @if($galeri->kategori == 'Foto')
                            <img src="{{ asset('storage/galeri/' . $galeri->file) }}" width="150" height="100" style="object-fit: cover; border-radius: 8px;" alt="File Galeri">
                        @elseif($galeri->kategori == 'Video')
                            <video width="250" controls>
                                <source src="{{ asset('storage/galeri/' . $galeri->file) }}">
                                Browser kamu tidak mendukung video.
                            </video>
                        @endif
                    @else
                        <span class="text-muted">Tidak ada file</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label class="form-label">Ganti File</label>
                    <input type="file" name="file" class="form-control" accept="image/jpeg,image/png,video/mp4,video/quicktime,video/x-msvideo">
                    <small class="text-muted">Kosongkan jika tidak ingin mengganti file.</small>
                    @error('file')
                        <small class="text-danger d-block">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="form-label">Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal', \Carbon\Carbon::parse($galeri->tanggal)->format('Y-m-d')) }}" required>
                    @error('tanggal')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <a href="{{ route('admin.galeri.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-green">
                    <i class="bi bi-save"></i>
                    Simpan Perubahan
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
