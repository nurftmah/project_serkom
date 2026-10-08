@extends('layouts.admin')
@section('title', 'Data Prestasi')

@section('content')

<div class="container-fluid">

    <!-- JUDUL -->
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h3 class="mb-1">Data Prestasi</h3>

            <p class="text-muted mb-0">
                Kelola prestasi sekolah
            </p>
        </div>

        <a href="{{ route('admin.prestasi.create') }}"
           class="btn btn-green">
            + Tambah Prestasi
        </a>

    </div>


    <!-- PESAN -->
    @if(session('success'))

        <div class="alert alert-success">
            {{ session('success') }}
        </div>

    @endif


    <!-- CARD -->
    <div class="card border-0 shadow-sm">

        <div class="card-body">

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

            <!-- TABEL -->
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th width="50">
                                No
                            </th>

                            <th width="100">
                                Foto
                            </th>

                            <th>
                                Nama Prestasi
                            </th>

                            <th>
                                Deskripsi
                            </th>

                            <th>
                                Tahun Ajaran
                            </th>

                            <th width="150">
                                Aksi
                            </th>

                        </tr>
                    </thead>
                    <tbody>

                        @forelse($prestasis as $prestasi)

                        <tr>

                            <!-- NO -->
                            <td>
                                {{ $loop->iteration }}
                            </td>


                            <!-- FOTO -->
                            <td>

                                @if($prestasi->foto)

                                    <img
                                        src="{{ asset('uploads/prestasi/' . $prestasi->foto) }}"
                                        width="80"
                                        height="60"
                                        style="object-fit: cover; border-radius: 8px;"
                                        alt="Foto prestasi"
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
                                    {{ $prestasi->nama_prestasi }}
                                </strong>

                            </td>


                            <!-- DESKRIPSI -->
                            <td>

                                {{ \Illuminate\Support\Str::limit(
                                    $prestasi->deskripsi,
                                    100
                                ) }}

                            </td>


                            <!-- TAHUN -->
                            <td>

                                {{ $prestasi->tahun_ajaran }}

                            </td>


                            <!-- AKSI -->
                            <td>

                                <div class="d-flex gap-1">

                                    <a
                                        href="{{ route('admin.prestasi.edit', ['id' => Crypt::encryptString((string)$prestasi->id_prestasi)]) }}"
                                        class="btn btn-warning btn-sm"
                                    >
                                       <i class="bi bi-pencil me-1"></i>
                                    </a>


                                    <form
                                        action="{{ route('admin.prestasi.destroy', ['id' => Crypt::encryptString((string)$prestasi->id_prestasi)]) }}"
                                        method="POST"
                                        onsubmit="return confirm(
                                            'Yakin ingin menghapus prestasi ini?'
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
                                colspan="6"
                                class="text-center py-4"
                            >

                                <span class="text-muted">
                                    Belum ada data prestasi.
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
