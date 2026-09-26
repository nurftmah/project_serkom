@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <!-- JUDUL -->
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h3 class="mb-1">Data Guru</h3>

            <p class="text-muted mb-0">
                Kelola data guru sekolah
            </p>
        </div>

        <a
            href="{{ route('admin.guru.create') }}"
            class="btn btn-primary"
        >
            <i class="bi bi-plus"></i>
            Tambah Guru
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
            <form
                action="{{ route('admin.guru.index') }}"
                method="GET"
                class="mb-4"
            >

                <div class="row">

                    <div class="col-md-5">

                        <input
                            type="text"
                            name="keyword"
                            class="form-control"
                            placeholder="Cari nama, NIP, atau mata pelajaran..."
                            value="{{ $keyword ?? '' }}"
                        >

                    </div>


                    <div class="col-md-auto">

                        <button
                            type="submit"
                            class="btn btn-secondary"
                        >
                            <i class="bi bi-search"></i>
                            Cari
                        </button>

                        <a
                            href="{{ route('admin.guru.index') }}"
                            class="btn btn-light"
                        >
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

                            <th width="50">No</th>

                            <th width="100">Foto</th>

                            <th>Nama Guru</th>

                            <th>NIP</th>

                            <th>Mata Pelajaran</th>

                            <th width="100" class="text-center">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse($gurus as $guru)

                        <tr>

                            <!-- NO -->
                            <td>
                                {{ $loop->iteration }}
                            </td>


                            <!-- FOTO -->
                            <td>

                                @if($guru->foto)

                                    <img
                                        src="{{ asset('uploads/guru/' . $guru->foto) }}"
                                        width="60"
                                        height="60"
                                        style="
                                            object-fit: cover;
                                            border-radius: 50%;
                                        "
                                        alt="Foto Guru"
                                    >

                                @else

                                    <span class="text-muted">
                                        Tidak ada
                                    </span>

                                @endif

                            </td>


                            <!-- NAMA -->
                            <td>

                                <strong>
                                    {{ $guru->nama_guru }}
                                </strong>

                            </td>


                            <!-- NIP -->
                            <td>
                                {{ $guru->nip }}
                            </td>


                            <!-- MAPEL -->
                            <td>
                                {{ $guru->mapel }}
                            </td>


                            <!-- AKSI -->
                            <td class="text-center">

                                <div class="d-flex justify-content-center gap-2">


                                    <!-- EDIT -->
                                    <a
                                        href="{{ route(
                                            'admin.guru.edit',
                                            $guru->id_guru
                                        ) }}"
                                        class="btn btn-warning btn-sm"
                                        title="Edit"
                                    >
                                        <i class="bi bi-pencil"></i>
                                    </a>


                                    <!-- HAPUS -->
                                    <form
                                        action="{{ route(
                                            'admin.guru.destroy',
                                            $guru->id_guru
                                        ) }}"
                                        method="POST"
                                        onsubmit="return confirm(
                                            'Yakin ingin menghapus data guru ini?'
                                        )"
                                    >

                                        @csrf

                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn btn-danger btn-sm"
                                            title="Hapus"
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
                                colspan="6"
                                class="text-center py-5"
                            >

                                <div class="text-muted">

                                    <i
                                        class="bi bi-person-x"
                                        style="font-size: 40px;"
                                    ></i>

                                    <p class="mt-2 mb-0">
                                        Belum ada data guru.
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
