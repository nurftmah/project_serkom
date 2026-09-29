@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    {{-- =========================
         JUDUL HALAMAN
    ========================== --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h3 class="mb-1">
                Data Siswa
            </h3>

            <p class="text-muted mb-0">
                Kelola data siswa sekolah
            </p>

        </div>


        {{-- TOMBOL TAMBAH SISWA
             HANYA UNTUK ADMIN --}}
        @auth

            @if(Auth::user()->role === 'Admin')

                <a href="{{ route('admin.siswa.create') }}"
                   class="btn btn-primary">

                    <i class="bi bi-plus-lg me-1"></i>
                    Tambah Siswa

                </a>

            @endif

        @endauth

    </div>



    {{-- =========================
         PESAN BERHASIL
    ========================== --}}
    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show"
             role="alert">

            <i class="bi bi-check-circle me-2"></i>

            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>

        </div>

    @endif



    {{-- =========================
         CARD DATA SISWA
    ========================== --}}
    <div class="card border-0 shadow-sm">

        <div class="card-body p-4">


            {{-- =========================
                 SEARCH
            ========================== --}}
            <form action="{{ route('admin.siswa.index') }}"
                  method="GET"
                  class="mb-4">

                <div class="row g-2">

                    <div class="col-md-5">

                        <input
                            type="text"
                            name="keyword"
                            class="form-control"
                            placeholder="Cari NISN atau nama siswa..."
                            value="{{ $keyword ?? '' }}"
                        >

                    </div>


                    <div class="col-md-auto">

                        <button type="submit"
                                class="btn btn-secondary">

                            <i class="bi bi-search me-1"></i>
                            Cari

                        </button>


                        <a href="{{ route('admin.siswa.index') }}"
                           class="btn btn-light">

                            Reset

                        </a>

                    </div>

                </div>

            </form>



            {{-- =========================
                 INFO UNTUK OPERATOR
            ========================== --}}
            @auth

                @if(Auth::user()->role === 'Operator')

                    <div class="alert alert-info d-flex align-items-center mb-4">

                        <i class="bi bi-info-circle me-2"></i>

                        <div>

                            Anda login sebagai
                            <strong>Operator</strong>.

                            Anda hanya dapat melihat data siswa.

                        </div>

                    </div>

                @endif

            @endauth



            {{-- =========================
                 TABEL DATA SISWA
            ========================== --}}
            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="table-light">

                        <tr>

                            <th width="60">
                                No
                            </th>

                            <th>
                                NISN
                            </th>

                            <th>
                                Nama Siswa
                            </th>

                            <th>
                                Jenis Kelamin
                            </th>

                            <th>
                                Tahun Masuk
                            </th>


                            {{-- KOLOM AKSI HANYA ADMIN --}}
                            @auth

                                @if(Auth::user()->role === 'Admin')

                                    <th width="180">
                                        Aksi
                                    </th>

                                @endif

                            @endauth

                        </tr>

                    </thead>


                    <tbody>

                        @forelse($siswas as $siswa)

                            <tr>


                                {{-- =====================
                                     NO
                                ====================== --}}
                                <td>

                                    {{ $loop->iteration }}

                                </td>



                                {{-- =====================
                                     NISN
                                ====================== --}}
                                <td>

                                    {{ $siswa->nisn }}

                                </td>



                                {{-- =====================
                                     NAMA SISWA
                                ====================== --}}
                                <td>

                                    <strong>
                                        {{ $siswa->nama_siswa }}
                                    </strong>

                                </td>



                                {{-- =====================
                                     JENIS KELAMIN
                                ====================== --}}
                                <td>

                                    {{ $siswa->jenis_kelamin }}

                                </td>



                                {{-- =====================
                                     TAHUN MASUK
                                ====================== --}}
                                <td>

                                    {{ $siswa->tahun_masuk }}

                                </td>



                                {{-- =====================
                                     AKSI
                                     HANYA ADMIN
                                ====================== --}}
                                @auth

                                    @if(Auth::user()->role === 'Admin')

                                        <td>


                                            {{-- EDIT --}}
                                            <a
                                                href="{{ route('admin.siswa.edit', $siswa->id_siswa) }}"
                                                class="btn btn-sm btn-warning me-1"
                                            >

                                                <i class="bi bi-pencil me-1"></i>

                                            </a>



                                            {{-- HAPUS --}}
                                            <form
                                                action="{{ route('admin.siswa.destroy', $siswa->id_siswa) }}"
                                                method="POST"
                                                class="d-inline"
                                            >

                                                @csrf

                                                @method('DELETE')


                                                <button
                                                    type="submit"
                                                    class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Yakin ingin menghapus data siswa ini?')"
                                                >

                                                    <i class="bi bi-trash me-1"></i>

                                                </button>

                                            </form>

                                        </td>

                                    @endif

                                @endauth

                            </tr>


                        @empty


                            {{-- =====================
                                 DATA KOSONG
                            ====================== --}}
                            <tr>

                                <td
                                    colspan="{{ Auth::check() && Auth::user()->role === 'Admin' ? 6 : 5 }}"
                                    class="text-center py-5"
                                >

                                    <div class="text-muted">

                                        <i class="bi bi-people fs-1"></i>

                                        <p class="mt-3 mb-0">
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
