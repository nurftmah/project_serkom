@extends('layouts.admin')
@section('title', 'Data Prestasi')

@section('content')

<div class="container-fluid">

    <div class="mb-4">

        <h3 class="mb-1">
            Edit Prestasi
        </h3>

        <p class="text-muted">
            Perbarui data prestasi sekolah
        </p>

    </div>


    <!-- ERROR -->
    @if($errors->any())

        <div class="alert alert-danger">

            <ul class="mb-0">

                @foreach($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    <div class="card border-0 shadow-sm">

        <div class="card-body">

            <form
                action="{{ route('admin.prestasi.update',  ['id' => Crypt::encryptString((string)$prestasi->id_prestasi)]) }}"
                method="POST"
                enctype="multipart/form-data"
            >

                @csrf

                @method('PUT')


                <!-- NAMA PRESTASI -->
                <div class="mb-3">

                    <label class="form-label">
                        Nama Prestasi
                    </label>

                    <input
                        type="text"
                        name="nama_prestasi"
                        class="form-control"
                        value="{{ old(
                            'nama_prestasi',
                            $prestasi->nama_prestasi
                        ) }}"
                        maxlength="40"
                        required
                    >

                </div>


                <!-- DESKRIPSI -->
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
                        $prestasi->deskripsi
                    ) }}</textarea>

                </div>


                <!-- FOTO LAMA -->
                <div class="mb-3">

                    <label class="form-label">
                        Foto Saat Ini
                    </label>

                    <br>

                    @if($prestasi->foto)

                        <img
                            src="{{ asset(
                                'uploads/prestasi/' . $prestasi->foto
                            ) }}"
                            width="150"
                            height="100"
                            style="object-fit: cover; border-radius: 8px;"
                            alt="Foto prestasi"
                        >

                    @else

                        <p class="text-muted">
                            Tidak ada foto.
                        </p>

                    @endif

                </div>


                <!-- FOTO BARU -->
                <div class="mb-3">

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

                </div>


                <!-- TAHUN AJARAN -->
                <div class="mb-4">

                    <label class="form-label">
                        Tahun Ajaran
                    </label>

                    <input
                        type="number"
                        name="tahun_ajaran"
                        class="form-control"
                        value="{{ old(
                            'tahun_ajaran',
                            $prestasi->tahun_ajaran
                        ) }}"
                        min="2000"
                        max="2100"
                        required
                    >

                </div>


                <!-- BUTTON -->
                <a
                    href="{{ route('admin.prestasi.index') }}"
                    class="btn btn-secondary"
                >
                    Batal
                </a>

                <button
                    type="submit"
                    class="btn btn-green"
                >
                    <i class="bi bi-save"></i>
                    Simpan Perubahan
                </button>

            </form>

        </div>

    </div>

</div>

@endsection
