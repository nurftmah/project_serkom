@extends('layouts.admin')
@section('title', 'Data Prestasi')
@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="mb-1">Data Prestasi</h3>
            <p class="text-muted mb-0">Kelola prestasi sekolah</p>
        </div>
        <a href="{{ route('admin.prestasi.create') }}" class="btn btn-green">
            <i class="bi bi-plus-lg me-1"></i>Tambah Prestasi
        </a>
    </div>
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th width="50">No</th>
                            <th width="100">Foto</th>
                            <th>Nama Prestasi</th>
                            <th>Deskripsi</th>
                            <th>Tahun Ajaran</th>
                            <th width="120">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($prestasis as $prestasi)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    @if($prestasi->foto && \Illuminate\Support\Facades\Storage::disk('public')->exists('prestasi/' . $prestasi->foto))
                                        <img src="{{ asset('storage/prestasi/' . $prestasi->foto) }}" width="80" height="60" style="object-fit: cover; border-radius: 8px;" alt="Foto {{ $prestasi->nama_prestasi }}">
                                    @else
                                        <span class="text-muted">Tidak ada</span>
                                    @endif
                                </td>
                                <td><strong>{{ $prestasi->nama_prestasi }}</strong></td>
                                <td>{{ \Illuminate\Support\Str::limit($prestasi->deskripsi, 100) }}</td>
                                <td>{{ $prestasi->tahun_ajaran }}</td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <a href="{{ route('admin.prestasi.edit', ['id' => Crypt::encryptString((string) $prestasi->id_prestasi)]) }}" class="btn btn-warning btn-sm" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('admin.prestasi.destroy', ['id' => Crypt::encryptString((string) $prestasi->id_prestasi)]) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus prestasi ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">
                                    <i class="bi bi-trophy fs-3 d-block mb-2 text-muted"></i>
                                    <span class="text-muted">Belum ada data prestasi.</span>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
