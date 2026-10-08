@extends('layouts.admin')
@section('title', 'Data Prestasi')

@section('content')

<div class="container-fluid">

    <div class="mb-4">

        <h3 class="mb-1">
            Tambah Prestasi
        </h3>

        <p class="text-muted">
            Tambahkan prestasi sekolah
        </p>

    </div>


    <!-- ERROR -->
    @if($errors->any())

        <div class="alert alert-danger">

            <ul class="mb-0">

                @foreach($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    <div class="card border-0 shadow-sm">

        <div class="card-body">

            <form
                action="{{ route('admin.prestasi.store') }}"
                method="POST"
                enctype="multipart/form-data"
            >

                @csrf


                <!-- NAMA PRESTASI -->
                <div class="mb-3">

                    <label class="form-label">
                        Nama Prestasi
                    </label>

                    <input
                        type="text"
                        name="nama_prestasi"
                        class="form-control"
                        value="{{ old('nama_prestasi') }}"
                        placeholder="Contoh: Juara 1 Lomba Futsal"
                        maxlength="40"
                        required
                    >

                </div>


                <!-- DESKRIPSI -->
                <div class="mb-3">

                    <label class="form-label">
                        Deskripsi
                    </label>

                    <textarea
                        name="deskripsi"
                        class="form-control"
                        rows="5"
                        placeholder="Masukkan deskripsi prestasi..."
                        required
                    >{{ old('deskripsi') }}</textarea>

                </div>


                <!-- FOTO -->
                <div class="mb-3">

                    <label class="form-label">
                        Foto
                    </label>

                    <input
                        type="file"
                        name="foto"
                        class="form-control"
                        accept=".jpg,.jpeg,.png"
                        required
                    >

                    <small class="text-muted">
                        Format JPG, JPEG, PNG. Maksimal 2 MB.
                    </small>

                </div>


                <!-- TAHUN AJARAN -->
                <div class="mb-4">

                    <label class="form-label">
                        Tahun Ajaran
                    </label>

                    <input
                        type="number"
                        name="tahun_ajaran"
                        class="form-control"
                        value="{{ old('tahun_ajaran') }}"
                        placeholder="Contoh: 2026"
                        min="2000"
                        max="2100"
                        required
                    >

                </div>


                <!-- BUTTON -->
                <a
                    href="{{ route('admin.prestasi.index') }}"
                    class="btn btn-secondary"
                >
                    Kembali
                </a>

                <button type="submit" class="btn btn-green">
                    <i class="bi bi-save"></i>
                    Simpan Data
                </button>

            </form>

        </div>

    </div>

</div>

@endsection
