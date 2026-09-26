@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <div class="mb-4">
        <h3>Edit Galeri</h3>
        <p class="text-muted">
            Ubah data galeri sekolah
        </p>
    </div>


    <div class="card border-0 shadow-sm">

        <div class="card-body">

            <form
                action="{{ route(
                    'admin.galeri.update',
                    $galeri->id_galeri
                ) }}"
                method="POST"
                enctype="multipart/form-data"
            >

                @csrf
                @method('PUT')


                <!-- JUDUL -->
                <div class="mb-3">

                    <label class="form-label">
                        Judul
                    </label>

                    <input
                        type="text"
                        name="judul"
                        class="form-control"
                        value="{{ old('judul', $galeri->judul) }}"
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
                    >{{ old('keterangan', $galeri->keterangan) }}</textarea>

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

                        <option value="Foto"
                            {{ old('kategori', $galeri->kategori) == 'Foto' ? 'selected' : '' }}>
                            Foto
                        </option>

                        <option value="Video"
                            {{ old('kategori', $galeri->kategori) == 'Video' ? 'selected' : '' }}>
                            Video
                        </option>

                    </select>

                </div>


                <!-- FILE LAMA -->
                <div class="mb-3">

                    <label class="form-label">
                        File Saat Ini
                    </label>

                    <br>

                    @if($galeri->file)

                        @if($galeri->kategori == 'Foto')

                            <img
                                src="{{ asset(
                                    'uploads/galeri/' . $galeri->file
                                ) }}"
                                width="150"
                                style="border-radius: 8px;"
                            >

                        @else

                            <video
                                width="250"
                                controls
                            >
                                <source
                                    src="{{ asset(
                                        'uploads/galeri/' . $galeri->file
                                    ) }}"
                                >
                            </video>

                        @endif

                    @endif

                </div>


                <!-- FILE BARU -->
                <div class="mb-3">

                    <label class="form-label">
                        Ganti File
                    </label>

                    <input
                        type="file"
                        name="file"
                        class="form-control"
                    >

                    <small class="text-muted">
                        Kosongkan jika tidak ingin mengganti file.
                    </small>

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
                        value="{{ old(
                            'tanggal',
                            $galeri->tanggal
                        ) }}"
                        required
                    >

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
                    class="btn btn-primary"
                >
                    Update
                </button>

            </form>

        </div>

    </div>

</div>

@endsection
