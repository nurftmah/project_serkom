@extends('layouts.admin')
@section('title', 'Data Pengumuman')

@section('content')

<div class="container-fluid">

    <!-- =========================
         JUDUL
    ========================= -->
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h3 class="mb-1">
                Data Pengumuman
            </h3>

            <p class="text-muted mb-0">
                Kelola pengumuman sekolah
            </p>
        </div>


        <!-- TAMBAH -->
        <a
            href="{{ route('admin.pengumuman.create') }}"
            class="btn btn-green"
        >
            <i class="bi bi-plus-lg"></i>
            Tambah Pengumuman
        </a>

    </div>



    <!-- =========================
         PESAN SUKSES
    ========================= -->
    @if(session('success'))

        <div class="alert alert-success">
            {{ session('success') }}
        </div>

    @endif


    <!-- =========================
         PESAN ERROR
    ========================= -->
    {{-- @if(session('error'))

        <div class="alert alert-danger">
            {{ session('error') }}
        </div>

    @endif --}}



    <!-- =========================
         CARD
    ========================= -->
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

            <!-- =========================
                 TABEL
            ========================= -->
            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead>

                        <tr>

                            <th width="60">
                                No
                            </th>

                            <th>
                                Judul
                            </th>

                            <th>
                                Isi
                            </th>

                            <th width="150">
                                Tanggal
                            </th>

                            <th width="120">
                                Status
                            </th>

                            <th width="170" class="text-center">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse($pengumumans as $pengumuman)

                            <tr>

                                <!-- NO -->
                                <td>
                                    {{ $loop->iteration }}
                                </td>


                                <!-- JUDUL -->
                                <td>

                                    <strong>
                                        {{ $pengumuman->judul }}
                                    </strong>

                                </td>


                                <!-- ISI -->
                                <td>

                                    {{ Str::limit(
                                        strip_tags($pengumuman->isi),
                                        70
                                    ) }}

                                </td>


                                <!-- TANGGAL -->
                                <td>

                                    {{ \Carbon\Carbon::parse(
                                        $pengumuman->tanggal
                                    )->format('d-m-Y') }}

                                </td>


                                <!-- STATUS -->
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


                                <!-- AKSI -->
                                <td>

                                    <div class="d-flex justify-content-center gap-2">

                                        <!-- EDIT -->
                                        <a
                                            href="{{ route('admin.pengumuman.edit', ['id' => Crypt::encryptString((string)$pengumuman->id_pengumuman)] ) }}"
                                            class="btn btn-warning btn-sm"
                                            title="Edit"
                                        >
                                            <i class="bi bi-pencil"></i>
                                        </a>


                                        <!-- HAPUS -->
                                        <form
                                            action="{{ route('admin.pengumuman.destroy', ['id' => Crypt::encryptString((string)$pengumuman->id_pengumuman)]) }}"
                                            method="POST"
                                            onsubmit="return confirm(
                                                'Yakin ingin menghapus pengumuman ini?'
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
                                            class="bi bi-megaphone"
                                            style="font-size: 40px;"
                                        ></i>

                                        <p class="mt-2 mb-0">
                                            Belum ada data pengumuman.
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
