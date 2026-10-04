@extends('layouts.admin')
@section('title', 'Data Guru')

@section('content')

<div class="container-fluid">

    <div class="mb-4">

        <h3 class="mb-1">
            Tambah Guru
        </h3>

        <p class="text-muted">
            Tambahkan data guru baru
        </p>

    </div>


    <div class="card border-0 shadow-sm">

        <div class="card-body">

            <form
                action="{{ route('admin.guru.store') }}"
                method="POST"
                enctype="multipart/form-data"
            >

                @csrf


                <!-- NAMA -->
                <div class="mb-3">

                    <label class="form-label">
                        Nama Guru
                    </label>

                    <input
                        type="text"
                        name="nama_guru"
                        class="form-control"
                        value="{{ old('nama_guru') }}"
                        placeholder="Masukkan nama guru"
                    >

                    @error('nama_guru')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror

                </div>


                <!-- NIP -->
                <div class="mb-3">

                    <label class="form-label">
                        NIP
                    </label>

                    <input
                        type="text"
                        name="nip"
                        class="form-control"
                        value="{{ old('nip') }}"
                        placeholder="Masukkan NIP"
                    >

                    @error('nip')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror

                </div>


                <!-- MAPEL -->
                <div class="mb-3">

                    <label class="form-label">
                        Mata Pelajaran
                    </label>

                    <input
                        type="text"
                        name="mapel"
                        class="form-control"
                        value="{{ old('mapel') }}"
                        placeholder="Contoh: Matematika"
                    >

                    @error('mapel')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror

                </div>


                <!-- FOTO -->
                <div class="mb-4">

                    <label class="form-label">
                        Foto Guru
                    </label>

                    <input
                        type="file"
                        name="foto"
                        class="form-control"
                        accept=".jpg,.jpeg,.png"
                    >

                    <small class="text-muted">
                        Format JPG, JPEG, PNG. Maksimal 2 MB.
                    </small>

                    @error('foto')
                        <br>
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror

                </div>


                <!-- BUTTON -->
                <div>
                    <a
                        href="{{ route('admin.guru.index') }}"
                        class="btn btn-secondary"
                    >
                        Kembali
                    </a>

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        <i class="bi bi-save"></i>
                        Simpan Data
                    </button>



                </div>

            </form>

        </div>

    </div>

</div>

@endsection
