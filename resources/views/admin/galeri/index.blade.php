@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <!-- JUDUL -->
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h3 class="mb-1">Data Galeri</h3>
            <p class="text-muted mb-0">
                Kelola foto dan video sekolah
            </p>
        </div>

        <a href="{{ route('admin.galeri.create') }}"
           class="btn btn-primary">
            + Tambah Galeri
        </a>

    </div>


    <!-- CARD -->
    <div class="card border-0 shadow-sm">

        <div class="card-body">

            <!-- PESAN -->
            @if(session('success'))

                <div class="alert alert-success">
                    {{ session('success') }}
                </div>

            @endif


            <!-- SEARCH -->
            <form action="{{ route('admin.galeri.index') }}"
                  method="GET"
                  class="mb-4">

                <div class="row">

                    <div class="col-md-5">

                        <input
                            type="text"
                            name="keyword"
                            class="form-control"
                            placeholder="Cari judul galeri..."
                            value="{{ $keyword ?? '' }}"
                        >

                    </div>

                    <div class="col-md-auto">

                        <button class="btn btn-secondary">
                            Cari
                        </button>

                        <a href="{{ route('admin.galeri.index') }}"
                           class="btn btn-light">
                            Reset
                        </a>

                    </div>

                </div>

            </form>


            <!-- TABEL -->
            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead>

                        <tr>
                            <th>No</th>
                            <th>File</th>
                            <th>Judul</th>
                            <th>Keterangan</th>
                            <th>Kategori</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>

                    </thead>

                    <tbody>

                        @forelse($galeris as $galeri)

                        <tr>

                            <td>
                                {{ $loop->iteration }}
                            </td>


                            <!-- FILE -->
                            <td>

                                @if($galeri->file)

                                    @if($galeri->kategori == 'Foto')

                                        <img
                                            src="{{ asset('uploads/galeri/' . $galeri->file) }}"
                                            width="80"
                                            height="60"
                                            style="object-fit: cover; border-radius: 6px;"
                                        >

                                    @else

                                        <video
                                            width="100"
                                            height="60"
                                            controls
                                        >
                                            <source
                                                src="{{ asset('uploads/galeri/' . $galeri->file) }}"
                                            >
                                        </video>

                                    @endif

                                @else

                                    <span class="text-muted">
                                        Tidak ada file
                                    </span>

                                @endif

                            </td>


                            <!-- JUDUL -->
                            <td>
                                <strong>
                                    {{ $galeri->judul }}
                                </strong>
                            </td>


                            <!-- KETERANGAN -->
                            <td>

                                {{ \Illuminate\Support\Str::limit(
                                    $galeri->keterangan,
                                    80
                                ) }}

                            </td>


                            <!-- KATEGORI -->
                            <td>

                                @if($galeri->kategori == 'Foto')

                                    <span class="badge bg-primary">
                                        Foto
                                    </span>

                                @else

                                    <span class="badge bg-danger">
                                        Video
                                    </span>

                                @endif

                            </td>


                            <!-- TANGGAL -->
                            <td>

                                {{ \Carbon\Carbon::parse(
                                    $galeri->tanggal
                                )->format('d-m-Y') }}

                            </td>


                            <!-- AKSI -->
                            <td>

                                <div class="d-flex gap-1">

                                    <a
                                        href="{{ route(
                                            'admin.galeri.edit',
                                            $galeri->id_galeri
                                        ) }}"
                                        class="btn btn-warning btn-sm"
                                    >
                                        <i class="bi bi-pencil me-1"></i>
                                    </a>


                                    <form
                                        action="{{ route(
                                            'admin.galeri.destroy',
                                            $galeri->id_galeri
                                        ) }}"
                                        method="POST"
                                        onsubmit="return confirm(
                                            'Yakin ingin menghapus data ini?'
                                        )"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn btn-danger btn-sm"
                                        >
                                            <i class="bi bi-trash"></i>

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td
                                colspan="7"
                                class="text-center py-4"
                            >
                                <span class="text-muted">
                                    Belum ada data galeri.
                                </span>
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
