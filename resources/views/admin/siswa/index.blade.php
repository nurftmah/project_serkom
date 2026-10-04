@php
    use Illuminate\Support\Facades\Crypt;
@endphp

@extends('layouts.admin')

@section('title', 'Data Siswa')

@section('content')

<div class="container-fluid">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="mb-1">Data Siswa</h3>
            <p class="text-muted mb-0">
                Kelola data siswa sekolah
            </p>
        </div>

        @auth
            @if (Auth::user()->role === 'Admin')
                <a href="{{ route('admin.siswa.create') }}"
                   class="btn btn-primary">
                    <i class="bi bi-plus-lg me-1"></i>
                    Tambah Siswa
                </a>
            @endif
        @endauth
    </div>


    <!-- ALERT SUCCESS -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">

            <i class="bi bi-check-circle me-2"></i>
            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>

        </div>
    @endif


    <div class="card border-0 shadow-sm">

        <div class="card-body">

            <!-- ALERT ERROR -->
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show"
                     role="alert">

                    <i class="bi bi-exclamation-circle me-2"></i>
                    {{ session('error') }}

                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="alert">
                    </button>

                </div>
            @endif


            <!-- FILTER JENIS KELAMIN -->
            <form action="{{ route('admin.siswa.index') }}"
                  method="GET"
                  class="mb-4">

                <div class="row g-2">

                    <div class="col-md-4">

                        <select name="jenis_kelamin"
                                class="form-select">

                            <option value="">
                                Semua Jenis Kelamin
                            </option>

                            <option value="Laki-Laki"
                                {{ ($jenisKelamin ?? '') == 'Laki-Laki' ? 'selected' : '' }}>
                                Laki-Laki
                            </option>

                            <option value="Perempuan"
                                {{ ($jenisKelamin ?? '') == 'Perempuan' ? 'selected' : '' }}>
                                Perempuan
                            </option>

                        </select>

                    </div>


                    <!-- FILTER -->
                    <div class="col-md-2">

                        <button type="submit"
                                class="btn btn-primary w-100">

                            <i class="bi bi-funnel me-1"></i>
                            Filter

                        </button>

                    </div>


                    <!-- RESET -->
                    <div class="col-md-2">

                        <a href="{{ route('admin.siswa.index') }}"
                           class="btn btn-secondary w-100">

                            <i class="bi bi-arrow-counterclockwise me-1"></i>
                            Reset

                        </a>

                    </div>

                </div>

            </form>


            <!-- TABLE -->
            <div class="table-responsive">

                <table class="table table-hover align-middle">

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

                            @auth
                                @if (Auth::user()->role === 'Admin')
                                    <th width="150">
                                        Aksi
                                    </th>
                                @endif
                            @endauth

                        </tr>

                    </thead>


                    <tbody>

                        @forelse ($siswas as $siswa)

                            <tr>

                                <!-- NO -->
                                <td>
                                    {{ $loop->iteration }}
                                </td>


                                <!-- NISN -->
                                <td>
                                    {{ $siswa->nisn }}
                                </td>


                                <!-- NAMA -->
                                <td>
                                    <strong>
                                        {{ $siswa->nama_siswa }}
                                    </strong>
                                </td>


                                <!-- JENIS KELAMIN -->
                                <td>
                                    {{ $siswa->jenis_kelamin }}
                                </td>


                                <!-- TAHUN MASUK -->
                                <td>
                                    {{ $siswa->tahun_masuk }}
                                </td>


                                <!-- AKSI -->
                                @auth

                                    @if (Auth::user()->role === 'Admin')

                                        <td>

                                            <!-- EDIT -->
                                            <a href="{{ route('admin.siswa.edit', [
                                                'id' => Crypt::encryptString((string) $siswa->id_siswa)
                                            ]) }}"
                                               class="btn btn-sm btn-warning me-1">

                                                <i class="bi bi-pencil"></i>

                                            </a>


                                            <!-- HAPUS -->
                                            <form action="{{ route('admin.siswa.destroy', [
                                                'id' => Crypt::encryptString((string) $siswa->id_siswa)
                                            ]) }}"
                                                  method="POST"
                                                  class="d-inline">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                        class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Yakin ingin menghapus data siswa ini?')">

                                                    <i class="bi bi-trash"></i>

                                                </button>

                                            </form>

                                        </td>

                                    @endif

                                @endauth

                            </tr>

                        @empty

                            <tr>

                                <td colspan="6"
                                    class="text-center py-5">

                                    <i class="bi bi-people fs-1 text-muted d-block mb-3"></i>

                                    <span class="text-muted">
                                        Belum ada data siswa.
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