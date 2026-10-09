@extends('layouts.admin')
@section('title', 'Data Guru')
@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="mb-1">Data Guru</h3>
            <p class="text-muted mb-0">Kelola data guru sekolah</p>
        </div>
        @auth
            @if(Auth::user()->role === 'Admin')
                <a href="{{ route('admin.guru.create') }}" class="btn btn-green">
                    <i class="bi bi-plus me-1"></i> Tambah Guru
                </a>
            @endif
        @endauth
    </div>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            @auth
                @if(Auth::user()->role === 'Operator')
                    <div class="alert alert-info d-flex align-items-center mb-4">
                        <i class="bi bi-info-circle me-2"></i>
                        <div>Anda login sebagai <strong>Operator</strong>. Anda hanya dapat melihat data guru.</div>
                    </div>
                @endif
            @endauth
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-circle me-2"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <form action="{{ route('admin.guru.index') }}" method="GET" class="mb-4">
                <div class="row g-2 align-items-end">
                    <div class="col-md-4">
                        <label for="mapel" class="form-label">Filter Mata Pelajaran</label>
                        <select name="mapel" id="mapel" class="form-select">
                            <option value="">Semua Mata Pelajaran</option>
                            @foreach($mapels as $mapel)
                                <option value="{{ $mapel->mapel }}" {{ request('mapel') == $mapel->mapel ? 'selected' : '' }}>
                                    {{ $mapel->mapel }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-green">
                            <i class="bi bi-funnel me-1"></i> Filter
                        </button>
                        <a href="{{ route('admin.guru.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-counterclockwise me-1"></i> Reset
                        </a>
                    </div>
                </div>
            </form>
            <div class="table-responsive" id="tabelGuru">
                <table class="table table-hover align-middle w-100">
                    <thead>
                        <tr>
                            <th width="50">No</th>
                            <th width="100">Foto</th>
                            <th>Nama Guru</th>
                            <th>NIP</th>
                            <th>Mata Pelajaran</th>
                            @auth
                                @if(Auth::user()->role === 'Admin')
                                    <th style="width: 100px;" class="text-center">Aksi</th>
                                @endif
                            @endauth
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($gurus as $guru)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    @if($guru->foto)
                                        <img src="{{ asset('storage/guru/' . $guru->foto) }}" width="45" height="45" style="object-fit: cover; border-radius: 50%;" alt="Foto {{ $guru->nama_guru }}">
                                    @else
                                        <span class="text-muted">Tidak ada</span>
                                    @endif
                                </td>
                                <td><strong>{{ $guru->nama_guru }}</strong></td>
                                <td>{{ $guru->nip }}</td>
                                <td>{{ $guru->mapel }}</td>
                                @auth
                                    @if(Auth::user()->role === 'Admin')
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center gap-2">
                                                <a href="{{ route('admin.guru.edit', ['id' => Crypt::encryptString((string) $guru->id_guru)]) }}" class="btn btn-warning btn-sm" title="Edit">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <form action="{{ route('admin.guru.destroy', ['id' => Crypt::encryptString((string) $guru->id_guru)]) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data guru ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    @endif
                                @endauth
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ Auth::check() && Auth::user()->role === 'Admin' ? 6 : 5 }}" class="text-center py-4">
                                    <div class="text-muted">
                                        <i class="bi bi-person-x" style="font-size: 40px;"></i>
                                        <p class="mt-2 mb-0">Belum ada data guru.</p>
                                    </div>
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
