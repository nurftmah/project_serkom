@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <div class="mb-4">

        <h3 class="mb-1">Edit Berita</h3>

        <p class="text-muted mb-0">
            Perbarui data berita sekolah
        </p>

    </div>


    @if($errors->any())

        <div class="alert alert-danger">

            <ul class="mb-0">

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
                    'admin.berita.update',
                    $berita->id_berita
                ) }}"
                method="POST"
                enctype="multipart/form-data"
            >

                @csrf
                @method('PUT')


                <div class="mb-3">

                    <label class="form-label">
                        Judul Berita
                    </label>

                    <input
                        type="text"
                        name="judul"
                        class="form-control"
                        maxlength="50"
                        value="{{ old('judul', $berita->judul) }}"
                        required
                    >

                </div>


                <div class="mb-3">

                    <label class="form-label">
                        Isi Berita
                    </label>

                    <textarea
                        name="isi"
                        class="form-control"
                        rows="7"
                        required
                    >{{ old('isi', $berita->isi) }}</textarea>

                </div>


                <div class="mb-3">

                    <label class="form-label">
                        Tanggal
                    </label>

                    <input
                        type="date"
                        name="tanggal"
                        class="form-control"
                        value="{{ old('tanggal', $berita->tanggal) }}"
                        required
                    >

                </div>


                @if($berita->gambar)

                    <div class="mb-3">

                        <label class="form-label">
                            Gambar Saat Ini
                        </label>

                        <br>

                        <img
                            src="{{ asset('uploads/berita/' . $berita->gambar) }}"
                            width="180"
                            height="120"
                            style="object-fit: cover; border-radius: 8px;"
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
                        accept=".jpg,.jpeg,.png"
                    >

                    <small class="text-muted">
                        Kosongkan jika tidak ingin mengganti gambar.
                    </small>

                </div>


                <div class="mb-3">

                    <label class="form-label">
                        Status
                    </label>

                    <select name="status"
                            class="form-select"
                            required>

                        <option value="Publish"
                            {{ old('status', $berita->status) == 'Publish' ? 'selected' : '' }}>
                            Publish
                        </option>

                        <option value="Draft"
                            {{ old('status', $berita->status) == 'Draft' ? 'selected' : '' }}>
                            Draft
                        </option>

                    </select>

                </div>


                <div class="mt-4">

                    <a href="{{ route('admin.berita.index') }}"
                       class="btn btn-secondary">

                        Kembali

                    </a>

                    <button type="submit"
                            class="btn btn-primary">

                        <i class="bi bi-save"></i>
                        Update Berita

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection
