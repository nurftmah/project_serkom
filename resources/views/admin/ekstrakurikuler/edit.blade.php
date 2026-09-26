@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <div class="mb-4">

        <h3 class="mb-1">Edit Ekstrakurikuler</h3>

        <p class="text-muted mb-0">
            Perbarui data ekstrakurikuler
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

            <form
                action="{{ route(
                    'admin.ekstrakurikuler.update',
                    $ekstrakurikuler->id_ekskul
                ) }}"
                method="POST"
                enctype="multipart/form-data"
            >

                @csrf
                @method('PUT')


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
                        value="{{ old(
                            'nama_ekskul',
                            $ekstrakurikuler->nama_ekskul
                        ) }}"
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
                        value="{{ old(
                            'pembina',
                            $ekstrakurikuler->pembina
                        ) }}"
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
                        value="{{ old(
                            'jadwal_latihan',
                            $ekstrakurikuler->jadwal_latihan
                        ) }}"
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
                        required
                    >{{ old(
                        'deskripsi',
                        $ekstrakurikuler->deskripsi
                    ) }}</textarea>

                </div>


                {{-- GAMBAR LAMA --}}
                @if($ekstrakurikuler->gambar)

                    <div class="mb-3">

                        <label class="form-label">
                            Gambar Saat Ini
                        </label>

                        <br>

                        <img
                            src="{{ asset(
                                'uploads/ekstrakurikuler/' .
                                $ekstrakurikuler->gambar
                            ) }}"
                            width="150"
                            style="border-radius: 8px;"
                        >

                    </div>

                @endif


                {{-- GAMBAR BARU --}}
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


                {{-- BUTTON --}}
                <div class="mt-4">

                    <a href="{{ route('admin.ekstrakurikuler.index') }}"
                       class="btn btn-secondary">

                        Kembali

                    </a>

                    <button type="submit"
                            class="btn btn-primary">

                        <i class="bi bi-save"></i>
                        Update Data

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection
