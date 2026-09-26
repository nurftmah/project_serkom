@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <div class="mb-4">

        <h3 class="mb-1">Tambah Ekstrakurikuler</h3>

        <p class="text-muted mb-0">
            Tambahkan data ekstrakurikuler baru
        </p>

    </div>


    {{-- ERROR --}}
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

            <form action="{{ route('admin.ekstrakurikuler.store') }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf


                {{-- NAMA --}}
                <div class="mb-3">

                    <label class="form-label">
                        Nama Ekstrakurikuler
                    </label>

                    <input
                        type="text"
                        name="nama_ekskul"
                        class="form-control"
                        maxlength="40"
                        value="{{ old('nama_ekskul') }}"
                        placeholder="Contoh: Pramuka"
                        required
                    >

                </div>


                {{-- PEMBINA --}}
                <div class="mb-3">

                    <label class="form-label">
                        Pembina
                    </label>

                    <input
                        type="text"
                        name="pembina"
                        class="form-control"
                        maxlength="40"
                        value="{{ old('pembina') }}"
                        placeholder="Nama pembina"
                        required
                    >

                </div>


                {{-- JADWAL --}}
                <div class="mb-3">

                    <label class="form-label">
                        Jadwal Latihan
                    </label>

                    <input
                        type="text"
                        name="jadwal_latihan"
                        class="form-control"
                        maxlength="40"
                        value="{{ old('jadwal_latihan') }}"
                        placeholder="Contoh: Sabtu, 08.00 - 10.00"
                        required
                    >

                </div>


                {{-- DESKRIPSI --}}
                <div class="mb-3">

                    <label class="form-label">
                        Deskripsi
                    </label>

                    <textarea
                        name="deskripsi"
                        class="form-control"
                        rows="5"
                        placeholder="Masukkan deskripsi ekstrakurikuler"
                        required
                    >{{ old('deskripsi') }}</textarea>

                </div>


                {{-- GAMBAR --}}
                <div class="mb-3">

                    <label class="form-label">
                        Gambar
                    </label>

                    <input
                        type="file"
                        name="gambar"
                        class="form-control"
                        accept="image/png,image/jpeg"
                    >

                    <small class="text-muted">
                        Format JPG/JPEG/PNG, maksimal 2 MB.
                    </small>

                </div>


                {{-- BUTTON --}}
                <div class="mt-4">

                    <a href="{{ route('admin.ekstrakurikuler.index') }}"
                       class="btn btn-secondary">

                        Kembali

                    </a>

                    <button type="submit"
                            class="btn btn-primary">

                        <i class="bi bi-save"></i>
                        Simpan

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection
