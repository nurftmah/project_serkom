@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="mb-1">Data Pengumuman</h3>
            <p class="text-muted mb-0">
                Kelola pengumuman sekolah
            </p>
        </div>

        <a href="{{ route('admin.pengumuman.create') }}"
           class="btn btn-primary">
            + Tambah Pengumuman
        </a>
    </div>


    {{-- Pesan sukses --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Pesan error --}}
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif


    <div class="card shadow-sm">

        <div class="card-body">

            {{-- Pencarian --}}
            <form method="GET"
                  action="{{ route('admin.pengumuman.index') }}"
                  class="mb-3">

                <div class="row">

                    <div class="col-md-5">
                        <input type="text"
                               name="keyword"
                               class="form-control"
                               placeholder="Cari pengumuman..."
                               value="{{ $keyword }}">
                    </div>

                    <div class="col-md-2">
                        <button type="submit"
                                class="btn btn-primary">
                            Cari
                        </button>

                        <a href="{{ route('admin.pengumuman.index') }}"
                           class="btn btn-secondary">
                            Reset
                        </a>
                    </div>

                </div>

            </form>


            {{-- Tabel --}}
            <div class="table-responsive">

                <table class="table table-bordered table-hover">

                    <thead class="table-light">

                        <tr>
                            <th width="60">No</th>
                            <th>Judul</th>
                            <th>Isi</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th width="160">Aksi</th>
                        </tr>

                    </thead>

                    <tbody>

                        @forelse($pengumumans as $pengumuman)

                        <tr>

                            <td>
                                {{ $loop->iteration }}
                            </td>

                            <td>
                                {{ $pengumuman->judul }}
                            </td>

                            <td>
                                {{ Str::limit($pengumuman->isi, 80) }}
                            </td>

                            <td>
                                {{ date('d-m-Y', strtotime($pengumuman->tanggal)) }}
                            </td>

                            <td>

                                @if($pengumuman->status == 'Publish')

                                    <span class="badge bg-success">
                                        Publish
                                    </span>

                                @else

                                    <span class="badge bg-secondary">
                                        Draft
                                    </span>

                                @endif

                            </td>

                            <td>

                                <a href="{{ route('admin.pengumuman.edit', $pengumuman->id_pengumuman) }}"
                                   class="btn btn-warning btn-sm">
                                    Edit
                                </a>


                                <form action="{{ route('admin.pengumuman.destroy', $pengumuman->id_pengumuman) }}"
                                      method="POST"
                                      class="d-inline">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Yakin ingin menghapus pengumuman ini?')">
                                        Hapus
                                    </button>

                                </form>

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="6"
                                class="text-center">
                                Belum ada data pengumuman.
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
