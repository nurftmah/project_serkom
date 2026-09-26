@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <div class="mb-4">

        <h3 class="mb-1">
            Edit Data Guru
        </h3>

        <p class="text-muted">
            Ubah data guru
        </p>

    </div>


    <div class="card border-0 shadow-sm">

        <div class="card-body">

            <form
                action="{{ route('admin.guru.update', $guru->id_guru) }}"
                method="POST"
                enctype="multipart/form-data"
            >

                @csrf

                @method('PUT')


                <!-- NAMA -->
                <div class="mb-3">

                    <label class="form-label">
                        Nama Guru
                    </label>

                    <input
                        type="text"
                        name="nama_guru"
                        class="form-control"
                        value="{{ old('nama_guru', $guru->nama_guru) }}"
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
                        value="{{ old('nip', $guru->nip) }}"
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
                        value="{{ old('mapel', $guru->mapel) }}"
                        placeholder="Contoh: Matematika"
                    >

                    @error('mapel')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror

                </div>


                <!-- FOTO LAMA -->
                <div class="mb-3">

                    <label class="form-label">
                        Foto Saat Ini
                    </label>

                    <br>

                    @if($guru->foto)

                        <img
                            src="{{ asset('uploads/guru/' . $guru->foto) }}"
                            width="100"
                            height="100"
                            style="
                                object-fit: cover;
                                border-radius: 10px;
                            "
                            alt="Foto Guru"
                        >

                    @else

                        <p class="text-muted">
                            Belum ada foto
                        </p>

                    @endif

                </div>


                <!-- FOTO BARU -->
                <div class="mb-4">

                    <label class="form-label">
                        Ganti Foto
                    </label>

                    <input
                        type="file"
                        name="foto"
                        class="form-control"
                        accept=".jpg,.jpeg,.png"
                    >

                    <small class="text-muted">
                        Kosongkan jika tidak ingin mengganti foto.
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

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        <i class="bi bi-save"></i>
                        Simpan Perubahan
                    </button>


                    <a
                        href="{{ route('admin.guru.index') }}"
                        class="btn btn-secondary"
                    >
                        Kembali
                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection
