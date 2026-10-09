@extends('layouts.admin')
@section('title', 'Data Ekstrakurikuler')
@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="mb-1">Data Ekstrakurikuler</h3>
            <p class="text-muted mb-0">Kelola data ekstrakurikuler sekolah</p>
        </div>
        <a href="{{ route('admin.ekstrakurikuler.create') }}" class="btn btn-green">
            <i class="bi bi-plus-lg me-1"></i>Tambah Ekstrakurikuler
        </a>
    </div>
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th width="60">No</th>
                            <th>Gambar</th>
                            <th>Nama Ekstrakurikuler</th>
                            <th>Pembina</th>
                            <th>Jadwal Latihan</th>
                            <th>Deskripsi</th>
                            <th width="100" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($ekstrakurikulers as $ekstrakurikuler)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    @if($ekstrakurikuler->gambar)
                                        <img src="{{ asset('storage/ekstrakurikuler/' . $ekstrakurikuler->gambar) }}" alt="{{ $ekstrakurikuler->nama_ekskul }}" width="70" height="50" class="rounded" style="object-fit: cover;">
                                    @else
                                        <span class="text-muted">Tidak ada</span>
                                    @endif
                                </td>
                                <td><strong>{{ $ekstrakurikuler->nama_ekskul }}</strong></td>
                                <td>{{ $ekstrakurikuler->guru?->nama_guru ?? 'Belum ada pembina' }}</td>
                                <td>{{ $ekstrakurikuler->jadwal_latihan }}</td>
                                <td>{{ \Illuminate\Support\Str::limit($ekstrakurikuler->deskripsi, 50) }}</td>
                                <td class="text-center">
                                    <a href="{{ route('admin.ekstrakurikuler.edit', ['id' => Crypt::encryptString((string) $ekstrakurikuler->id_ekskul)]) }}" class="btn btn-sm btn-warning" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.ekstrakurikuler.destroy', ['id' => Crypt::encryptString((string) $ekstrakurikuler->id_ekskul)]) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')" title="Hapus">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">
                                    <i class="bi bi-collection fs-3 text-muted"></i>
                                    <p class="text-muted mt-2 mb-0">Belum ada data ekstrakurikuler.</p>
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
