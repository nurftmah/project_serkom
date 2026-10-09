@extends('layouts.admin')
@section('title', 'Data Siswa')

@section('content')

<div class="container-fluid">

    {{-- JUDUL --}}
    <div class="mb-4">

        <h3 class="mb-1">Tambah Siswa</h3>

        <p class="text-muted mb-0">
            Tambahkan data siswa baru
        </p>

    </div>


    {{-- ERROR VALIDASI --}}
    @if($errors->any())

        <div class="alert alert-danger">

            <strong>Data belum benar.</strong>

            <ul class="mb-0 mt-2">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- FORM --}}
    <div class="card border-0 shadow-sm">

        <div class="card-body">

            <form action="{{ route('admin.siswa.store') }}" method="POST">

                @csrf


                {{-- NISN --}}
                <div class="mb-3">

                    <label class="form-label">
                        NISN
                    </label>

                    <input
                        type="text"
                        name="nisn"
                        class="form-control"
                        maxlength="10"
                        value="{{ old('nisn') }}"
                        placeholder="Masukkan NISN"
                        required
                    >

                </div>


                {{-- NAMA --}}
                <div class="mb-3">

                    <label class="form-label">
                        Nama Siswa
                    </label>

                    <input
                        type="text"
                        name="nama_siswa"
                        class="form-control"
                        maxlength="40"
                        value="{{ old('nama_siswa') }}"
                        placeholder="Masukkan nama siswa"
                        required
                    >

                </div>


                {{-- JENIS KELAMIN --}}
                <div class="mb-3">

                    <label class="form-label">
                        Jenis Kelamin
                    </label>

                    <select
                        name="jenis_kelamin"
                        class="form-select"
                        required
                    >

                        <option value="">
                            -- Pilih Jenis Kelamin --
                        </option>

                        <option value="Laki-Laki"
                            {{ old('jenis_kelamin') == 'Laki-Laki' ? 'selected' : '' }}>
                            Laki-Laki
                        </option>

                        <option value="Perempuan"
                            {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>
                            Perempuan
                        </option>

                    </select>

                </div>

                {{-- KELAS --}}
                <div class="mb-3">
                    <label for="kelas" class="form-label">Kelas</label>
                    <select name="kelas" id="kelas" class="form-select" required>
                        <option value="">Pilih Kelas</option>
                        <option value="VII A">VII A</option>
                        <option value="VII B">VII B</option>
                        <option value="VIII A">VIII A</option>
                        <option value="VIII B">VIII B</option>
                        <option value="IX A">IX A</option>
                        <option value="IX B">IX B</option>
                    </select>
                </div>


                {{-- TAHUN MASUK --}}
                <div class="mb-3">
                    <label class="form-label">
                        Tahun Masuk
                    </label>
                    <input
                        type="number"
                        name="tahun_masuk"
                        class="form-control"
                        value="{{ old('tahun_masuk') }}"
                        placeholder="Contoh: 2026"
                        min="2000"
                        max="2100"
                        required
                    >
                </div>

                {{-- BUTTON --}}
                <div class="mt-4">

                    <a href="{{ route('admin.siswa.index') }}"
                       class="btn btn-secondary">

                        Kembali

                    </a>

                    <button type="submit"
                            class="btn btn-green">

                        <i class="bi bi-save"></i>
                        Simpan Data

                    </button>
                </div>
            </form>
        </div>

    </div>

</div>

@endsection
