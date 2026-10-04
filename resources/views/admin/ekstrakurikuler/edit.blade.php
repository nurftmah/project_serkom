@extends('layouts.admin')

@section('title', 'Edit Ekstrakurikuler')

@section('content')

<div class="container-fluid">

    <div class="mb-4">

        <h3 class="mb-1">Edit Ekstrakurikuler</h3>

        <p class="text-muted mb-0">
            Perbarui data ekstrakurikuler
        </p>

    </div>

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

    <div class="card border-0 shadow-sm">

        <div class="card-body">

            <form
                action="{{ route('admin.ekstrakurikuler.update',  ['id' => Crypt::encryptString((string) $ekstrakurikuler->id_ekskul)]) }}"
                method="POST"
                enctype="multipart/form-data"
            >

                @csrf

                @method('PUT')

                <div class="mb-3">

                    <label class="form-label">
                        Nama Ekstrakurikuler
                    </label>

                    <input
                        type="text"
                        name="nama_ekskul"
                        class="form-control"
                        maxlength="40"
                        value="{{ old('nama_ekskul', $ekstrakurikuler->nama_ekskul) }}"
                        required
                    >

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Pembina
                    </label>

                    <input
                        type="text"
                        name="pembina"
                        class="form-control"
                        maxlength="40"
                        value="{{ old('pembina', $ekstrakurikuler->pembina) }}"
                        required
                    >

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Jadwal Latihan
                    </label>

                    <input
                        type="text"
                        name="jadwal_latihan"
                        class="form-control"
                        maxlength="40"
                        value="{{ old('jadwal_latihan', $ekstrakurikuler->jadwal_latihan) }}"
                        required
                    >

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Deskripsi
                    </label>

                    <textarea
                        name="deskripsi"
                        class="form-control"
                        rows="5"
                        required
                    >{{ old('deskripsi', $ekstrakurikuler->deskripsi) }}</textarea>

                </div>

                @if($ekstrakurikuler->gambar)

                    <div class="mb-3">

                        <label class="form-label">
                            Gambar Saat Ini
                        </label>

                        <br>

                        <img
                            src="{{ asset('uploads/ekstrakurikuler/' . $ekstrakurikuler->gambar) }}"
                            width="150"
                            height="100"
                            style="object-fit: cover; border-radius: 8px;"
                            alt="Gambar Ekstrakurikuler"
                        >

                    </div>

                @endif

                <div class="mb-3">

                    <label class="form-label">
                        Ganti Gambar
                    </label>

                    <input
                        type="file"
                        name="gambar"
                        class="form-control"
                        accept="image/png,image/jpeg"
                    >

                    <small class="text-muted">
                        Kosongkan jika tidak ingin mengganti gambar.
                    </small>

                </div>

                <div class="mt-4">

                    <a href="{{ route('admin.ekstrakurikuler.index') }}" class="btn btn-secondary">
                        Batal
                    </a>

                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection