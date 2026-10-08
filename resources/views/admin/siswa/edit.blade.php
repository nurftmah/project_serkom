@extends('layouts.admin')
@section('title', 'Data Siswa')

@section('content')

<div class="container-fluid">

    {{-- JUDUL --}}
    <div class="mb-4">

        <h3 class="mb-1">Edit Data Siswa</h3>

        <p class="text-muted mb-0">
            Perbarui data siswa
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

            <form action="{{ route('admin.siswa.update',  ['id' => Crypt::encryptString((string)$siswa->id_siswa)]) }}"
                  method="POST">

                @csrf

                @method('PUT')


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
                        value="{{ old('nisn', $siswa->nisn) }}"
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
                        value="{{ old('nama_siswa', $siswa->nama_siswa) }}"
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

                        <option value="Laki-Laki"
                            {{ old('jenis_kelamin', $siswa->jenis_kelamin) == 'Laki-Laki' ? 'selected' : '' }}>
                            Laki-Laki
                        </option>

                        <option value="Perempuan"
                            {{ old('jenis_kelamin', $siswa->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>
                            Perempuan
                        </option>

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
                        value="{{ old('tahun_masuk', $siswa->tahun_masuk) }}"
                        min="2000"
                        max="2100"
                        required
                    >

                </div>


                {{-- BUTTON --}}
                <div class="mt-4">

                    <a href="{{ route('admin.siswa.index') }}"
                       class="btn btn-secondary">
                       Batal
                    </a>

                    <button type="submit" class="btn btn-green">
                        <i class="bi bi-save"></i>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
