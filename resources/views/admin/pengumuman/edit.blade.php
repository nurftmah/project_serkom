@extends('layouts.admin')
@section('title', 'Data Pengumuman')

@section('content')

<div class="container-fluid">

    <div class="mb-4">
        <h3>Edit Pengumuman</h3>
        <p class="text-muted">
            Perbarui data pengumuman
        </p>
    </div>


    <div class="card shadow-sm">

        <div class="card-body">

            <form action="{{ route('admin.pengumuman.update',  ['id' => Crypt::encryptString((string)$pengumuman->id_pengumuman)]) }}"
                  method="POST">

                @csrf
                @method('PUT')


                {{-- Judul --}}
                <div class="mb-3">

                    <label class="form-label">
                        Judul Pengumuman
                    </label>

                    <input type="text"
                           name="judul"
                           class="form-control"
                           value="{{ old('judul', $pengumuman->judul) }}">

                    @error('judul')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror

                </div>


                {{-- Isi --}}
                <div class="mb-3">

                    <label class="form-label">
                        Isi Pengumuman
                    </label>

                    <textarea name="isi"
                              class="form-control"
                              rows="5">{{ old('isi', $pengumuman->isi) }}</textarea>

                    @error('isi')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror

                </div>


                {{-- Tanggal --}}
                <div class="mb-3">

                    <label class="form-label">
                        Tanggal
                    </label>

                    <input type="date"
                           name="tanggal"
                           class="form-control"
                           value="{{ old('tanggal', $pengumuman->tanggal) }}">

                    @error('tanggal')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror

                </div>


                {{-- Status --}}
                <div class="mb-3">

                    <label class="form-label">
                        Status
                    </label>

                    <select name="status"
                            class="form-select">

                        <option value="Publish"
                            {{ old('status', $pengumuman->status) == 'Publish' ? 'selected' : '' }}>
                            Publish
                        </option>

                        <option value="Draft"
                            {{ old('status', $pengumuman->status) == 'Draft' ? 'selected' : '' }}>
                            Draft
                        </option>

                    </select>

                    @error('status')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror

                </div>


                <a href="{{ route('admin.pengumuman.index') }}"
                   class="btn btn-secondary">
                    Batal
                </a>

                <button type="submit"class="btn btn-primary">
                    <i class="bi bi-save"></i>
                    Simpan Perubahan
                </button>

            </form>

        </div>

    </div>

</div>

@endsection
