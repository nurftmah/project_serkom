@extends('layouts.admin')
@section('title', 'Data Ekstrakurikuler')

@section('content')

<div class="container-fluid">

    {{-- JUDUL --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h3 class="mb-1">Data Ekstrakurikuler</h3>

            <p class="text-muted mb-0">
                Kelola data ekstrakurikuler sekolah
            </p>
        </div>

        <a href="{{ route('admin.ekstrakurikuler.create') }}"
           class="btn btn-primary">

            <i class="bi bi-plus-lg"></i>
            Tambah Ekstrakurikuler

        </a>

    </div>


    {{-- PESAN SUKSES --}}
    @if(session('success'))

        <div class="alert alert-success">
            {{ session('success') }}
        </div>

    @endif


    {{-- CARD --}}
    <div class="card border-0 shadow-sm">

        <div class="card-body">

            {{-- SEARCH --}}
            {{-- <form action="{{ route('admin.ekstrakurikuler.index') }}"
                  method="GET"
                  class="mb-4">

                <div class="row">

                    <div class="col-md-5">

                        <input
                            type="text"
                            name="keyword"
                            class="form-control"
                            placeholder="Cari nama ekstrakurikuler atau pembina..."
                            value="{{ $keyword }}"
                        >

                    </div>

                    <div class="col-md-3">

                        <button type="submit"
                                class="btn btn-secondary">

                            <i class="bi bi-search"></i>
                            Cari

                        </button>

                        <a href="{{ route('admin.ekstrakurikuler.index') }}"
                           class="btn btn-light">

                            Reset

                        </a>

                    </div>

                </div>

            </form> --}}

               @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-circle me-2"></i>
                        {{ session('error') }}

                        <button type="button"
                                class="btn-close"
                                data-bs-dismiss="alert"
                                aria-label="Close"></button>
                    </div>
                @endif
            {{-- TABEL --}}
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

                            <th width="180">Aksi</th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse($ekstrakurikulers as $ekstrakurikuler)

                            <tr>

                                <td>
                                    {{ $loop->iteration }}
                                </td>


                                <td>

                                    @if($ekstrakurikuler->gambar)

                                        <img
                                            src="{{ asset('uploads/ekstrakurikuler/' . $ekstrakurikuler->gambar) }}"
                                            width="70"
                                            height="50"
                                            style="object-fit: cover; border-radius: 6px;"
                                        >

                                    @else

                                        <span class="text-muted">
                                            Tidak ada
                                        </span>

                                    @endif

                                </td>


                                <td>
                                    <strong>
                                        {{ $ekstrakurikuler->nama_ekskul }}
                                    </strong>
                                </td>


                                <td>
                                    {{ $ekstrakurikuler->pembina }}
                                </td>


                                <td>
                                    {{ $ekstrakurikuler->jadwal_latihan }}
                                </td>


                                <td>

                                    {{ Str::limit(
                                        $ekstrakurikuler->deskripsi,
                                        50
                                    ) }}

                                </td>


                                <td>

                                    {{-- EDIT --}}
                                    <a href="{{ route('admin.ekstrakurikuler.edit',  ['id' => Crypt::encryptString((string) $ekstrakurikuler->id_ekskul)]) }}"
                                       class="btn btn-sm btn-warning">

                                        <i class="bi bi-pencil"></i>

                                    </a>


                                    {{-- HAPUS --}}
                                    <form
                                        action="{{ route('admin.ekstrakurikuler.destroy', ['id' => Crypt::encryptString((string)$ekstrakurikuler->id_ekskul)]) }}"
                                        method="POST"
                                        class="d-inline"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('Yakin ingin menghapus data ini?')"
                                        >

                                            <i class="bi bi-trash"></i>

                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="7"
                                    class="text-center py-4">

                                    <div class="text-muted">

                                        <i class="bi bi-collection fs-3"></i>

                                        <p class="mt-2 mb-0">
                                            Belum ada data ekstrakurikuler.
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
