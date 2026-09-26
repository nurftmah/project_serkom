@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    {{-- JUDUL --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h3 class="mb-1">Data Siswa</h3>
            <p class="text-muted mb-0">
                Kelola data siswa sekolah
            </p>
        </div>

        <a href="{{ route('admin.siswa.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i>
            Tambah Siswa
        </a>

    </div>


    {{-- PESAN BERHASIL --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif


    {{-- CARD --}}
    <div class="card border-0 shadow-sm">

        <div class="card-body">

            {{-- SEARCH --}}
            <form action="{{ route('admin.siswa.index') }}" method="GET" class="mb-4">

                <div class="row">

                    <div class="col-md-5">
                        <input
                            type="text"
                            name="keyword"
                            class="form-control"
                            placeholder="Cari NISN atau nama siswa..."
                            value="{{ $keyword }}"
                        >
                    </div>

                    <div class="col-md-2">
                        <button type="submit" class="btn btn-secondary">
                            <i class="bi bi-search"></i>
                            Cari
                        </button>

                        <a href="{{ route('admin.siswa.index') }}"
                           class="btn btn-light">
                            Reset
                        </a>
                    </div>

                </div>

            </form>


            {{-- TABEL --}}
            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead class="table-light">

                        <tr>
                            <th width="60">No</th>
                            <th>NISN</th>
                            <th>Nama Siswa</th>
                            <th>Jenis Kelamin</th>
                            <th>Tahun Masuk</th>
                            <th width="180">Aksi</th>
                        </tr>

                    </thead>

                    <tbody>

                        @forelse($siswas as $siswa)

                            <tr>

                                <td>
                                    {{ $loop->iteration }}
                                </td>

                                <td>
                                    {{ $siswa->nisn }}
                                </td>

                                <td>
                                    <strong>{{ $siswa->nama_siswa }}</strong>
                                </td>

                                <td>
                                    {{ $siswa->jenis_kelamin }}
                                </td>

                                <td>
                                    {{ $siswa->tahun_masuk }}
                                </td>

                                <td>

                                    {{-- EDIT --}}
                                    <a href="{{ route('admin.siswa.edit', $siswa->id_siswa) }}"
                                       class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i>
                                        Edit
                                    </a>


                                    {{-- HAPUS --}}
                                    <form action="{{ route('admin.siswa.destroy', $siswa->id_siswa) }}"
                                          method="POST"
                                          class="d-inline">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="btn btn-sm btn-danger"
                                                onclick="return confirm('Yakin ingin menghapus data siswa ini?')">

                                            <i class="bi bi-trash"></i>
                                            Hapus

                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="6" class="text-center py-4">

                                    <div class="text-muted">
                                        <i class="bi bi-people fs-3"></i>

                                        <p class="mt-2 mb-0">
                                            Belum ada data siswa.
                                        </p>
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
