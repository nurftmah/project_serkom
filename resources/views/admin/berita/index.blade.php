@extends('layouts.admin')

@section('title', 'Data Berita')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h3 class="mb-1">Data Berita</h3>

            <p class="text-muted mb-0">
                Kelola berita sekolah
            </p>
        </div>

        <a
            href="{{ route('admin.berita.create') }}"
            class="btn btn-primary"
        >
            <i class="bi bi-plus"></i>
            Tambah Berita
        </a>

    </div>

    <div class="card border-0 shadow-sm">

        <div class="card-body">

            @if(session('success'))

                <div class="alert alert-success alert-dismissible fade show">

                    {{ session('success') }}

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="alert">
                    </button>

                </div>

            @endif

            @if(session('error'))

                <div class="alert alert-danger alert-dismissible fade show" role="alert">

                    <i class="bi bi-exclamation-circle me-2"></i>

                    {{ session('error') }}

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="alert"
                        aria-label="Close">
                    </button>

                </div>

            @endif

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead>

                        <tr>

                            <th width="50">
                                No
                            </th>

                            <th width="100">
                                Gambar
                            </th>

                            <th>
                                Judul
                            </th>

                            <th>
                                Slug
                            </th>

                            <th>
                                Isi Berita
                            </th>

                            <th width="120">
                                Tanggal
                            </th>

                            <th width="100">
                                Status
                            </th>

                            <th width="100" class="text-center">
                                Aksi
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($beritas as $berita)

                        <tr>

                            <td>
                                {{ $loop->iteration }}
                            </td>

                            <td>

                                @if($berita->gambar)

                                    <img
                                        src="{{ asset('uploads/berita/' . $berita->gambar) }}"
                                        width="70"
                                        height="50"
                                        style="object-fit: cover; border-radius: 6px;"
                                        alt="Gambar Berita"
                                    >

                                @else

                                    <span class="text-muted">
                                        Tidak ada
                                    </span>

                                @endif

                            </td>

                            <td>

                                <strong>
                                    {{ $berita->judul }}
                                </strong>

                            </td>

                            <td>

                                <span class="text-muted">
                                    {{ $berita->slug }}
                                </span>

                            </td>

                            <td>

                                <div style="max-width: 350px;">

                                    {{ \Illuminate\Support\Str::limit($berita->isi, 120) }}

                                </div>

                            </td>

                            <td>

                                {{ \Carbon\Carbon::parse($berita->tanggal)->format('d-m-Y') }}

                            </td>

                            <td>

                                @if($berita->status == 'Publish')

                                    <span class="badge bg-success">
                                        Publish
                                    </span>

                                @else

                                    <span class="badge bg-secondary">
                                        Draft
                                    </span>

                                @endif

                            </td>

                            <td class="text-center">

                                <div class="d-flex justify-content-center gap-2">

                                    <a
                                        href="{{ route('admin.berita.edit', ['id' => Crypt::encryptString((string) $berita->id_berita)]) }}"
                                        class="btn btn-warning btn-sm"
                                        title="Edit"
                                    >
                                        <i class="bi bi-pencil"></i>
                                    </a>

                                    <form
                                        action="{{ route('admin.berita.destroy', ['id' => Crypt::encryptString((string) $berita->id_berita)]) }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus berita ini?')"
                                    >

                                        @csrf

                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn btn-danger btn-sm"
                                            title="Hapus"
                                        >
                                            <i class="bi bi-trash"></i>
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td
                                colspan="8"
                                class="text-center py-5"
                            >

                                <div class="text-muted">

                                    <i
                                        class="bi bi-newspaper"
                                        style="font-size: 40px;"
                                    ></i>

                                    <p class="mb-0 mt-2">
                                        Belum ada data berita.
                                    </p>

                                </div>

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection
