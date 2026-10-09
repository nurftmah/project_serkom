@extends('layouts.admin')
@section('title', 'Tambah Berita')
@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <h3 class="mb-1">Tambah Berita</h3>
        <p class="text-muted mb-0">Tambahkan berita sekolah</p>
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
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Judul Berita</label>
                    <input type="text" name="judul" class="form-control" maxlength="50" value="{{ old('judul') }}" placeholder="Masukkan judul berita" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Slug</label>
                    <input type="text" name="slug" class="form-control" maxlength="100" value="{{ old('slug') }}" placeholder="contoh: kegiatan-pembukaan-tahun-ajaran-baru" required>
                    <small class="text-muted">Gunakan huruf kecil dan tanda hubung (-).</small>
                </div>
                <div class="mb-3">
                    <label class="form-label">Penulis</label>
                    <input type="text" class="form-control" value="{{ Auth::user()->username ?? 'Tidak diketahui' }}" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">Isi Berita</label>
                    <textarea name="isi" class="form-control" rows="7" placeholder="Tulis isi berita..." required>{{ old('isi') }}</textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal') }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Gambar</label>
                    <input type="file" name="gambar" class="form-control" accept=".jpg,.jpeg,.png" required>
                    <small class="text-muted">Format JPG, JPEG, atau PNG. Maksimal 2 MB.</small>
                </div>
                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select" required>
                        <option value="">-- Pilih Status --</option>
                        <option value="Publish" {{ old('status') == 'Publish' ? 'selected' : '' }}>Publish</option>
                        <option value="Draft" {{ old('status') == 'Draft' ? 'selected' : '' }}>Draft</option>
                    </select>
                </div>
                <div class="mt-4">
                    <a href="{{ route('admin.berita.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-green">
                        <i class="bi bi-save"></i>
                        Simpan Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
