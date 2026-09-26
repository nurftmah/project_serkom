@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <div class="mb-4">
        <h3>Tambah Pengumuman</h3>
        <p class="text-muted">
            Tambahkan pengumuman baru
        </p>
    </div>


    <div class="card shadow-sm">

        <div class="card-body">

            <form action="{{ route('admin.pengumuman.store') }}"
                  method="POST">

                @csrf


                {{-- Judul --}}
                <div class="mb-3">

                    <label class="form-label">
                        Judul Pengumuman
                    </label>

                    <input type="text"
                           name="judul"
                           class="form-control"
                           value="{{ old('judul') }}"
                           placeholder="Masukkan judul pengumuman">

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
                              rows="5"
                              placeholder="Masukkan isi pengumuman">{{ old('isi') }}</textarea>

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
                           value="{{ old('tanggal') }}">

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

                        <option value="">
                            -- Pilih Status --
                        </option>

                        <option value="Publish"
                            {{ old('status') == 'Publish' ? 'selected' : '' }}>
                            Publish
                        </option>

                        <option value="Draft"
                            {{ old('status') == 'Draft' ? 'selected' : '' }}>
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
                    Kembali
                </a>

                <button type="submit"
                        class="btn btn-primary">
                    Simpan
                </button>

            </form>

        </div>

    </div>

</div>

@endsection
