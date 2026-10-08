@extends('layouts.admin')
@section('title', 'Data Galeri')

@section('content')

<div class="container-fluid">

    <div class="mb-4">
        <h3>Tambah Galeri</h3>
        <p class="text-muted">
            Tambahkan foto atau video sekolah
        </p>
    </div>


    <div class="card border-0 shadow-sm">

        <div class="card-body">

            <form
                action="{{ route('admin.galeri.store') }}"
                method="POST"
                enctype="multipart/form-data"
            >

                @csrf


                <!-- JUDUL -->
                <div class="mb-3">

                    <label class="form-label">
                        Judul
                    </label>

                    <input
                        type="text"
                        name="judul"
                        class="form-control"
                        value="{{ old('judul') }}"
                        required
                    >

                    @error('judul')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror

                </div>


                <!-- KETERANGAN -->
                <div class="mb-3">

                    <label class="form-label">
                        Keterangan
                    </label>

                    <textarea
                        name="keterangan"
                        class="form-control"
                        rows="4"
                        required
                    >{{ old('keterangan') }}</textarea>

                    @error('keterangan')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror

                </div>


                <!-- KATEGORI -->
                <div class="mb-3">

                    <label class="form-label">
                        Kategori
                    </label>

                    <select
                        name="kategori"
                        class="form-select"
                        required
                    >

                        <option value="">
                            -- Pilih Kategori --
                        </option>

                        <option value="Foto"
                            {{ old('kategori') == 'Foto' ? 'selected' : '' }}>
                            Foto
                        </option>

                        <option value="Video"
                            {{ old('kategori') == 'Video' ? 'selected' : '' }}>
                            Video
                        </option>

                    </select>

                    @error('kategori')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror

                </div>


                <!-- FILE -->
                <div class="mb-3">

                    <label class="form-label">
                        File
                    </label>

                    <input
                        type="file"
                        name="file"
                        class="form-control"
                        required
                    >

                    <small class="text-muted">
                        Foto: JPG, JPEG, PNG |
                        Video: MP4, MOV, AVI
                    </small>

                    @error('file')
                        <small class="text-danger d-block">
                            {{ $message }}
                        </small>
                    @enderror

                </div>


                <!-- TANGGAL -->
                <div class="mb-4">

                    <label class="form-label">
                        Tanggal
                    </label>

                    <input
                        type="date"
                        name="tanggal"
                        class="form-control"
                        value="{{ old('tanggal') }}"
                        required
                    >

                    @error('tanggal')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror

                </div>


                <!-- BUTTON -->

                <a
                    href="{{ route('admin.galeri.index') }}"
                    class="btn btn-secondary"
                >
                    Kembali
                </a>

                <button
                    type="submit"
                    class="btn btn-green"
                >
                    <i class="bi bi-save"></i>
                    Simpan Data
                </button>

            </form>

        </div>

    </div>

</div>

@endsection
