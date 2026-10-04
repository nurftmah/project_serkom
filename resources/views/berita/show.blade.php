<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $berita->judul }} - MTS AL-AZHAR</title>

    <link rel="stylesheet" href="{{ asset('assets/libs/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/bootstrap-icons/bootstrap-icons.css') }}">

    <style>
        body {
            background-color: #f8f9fa;
        }

        .navbar {
            background-color: #16879a;
        }

        .navbar-brand {
            font-weight: 700;
        }

        .berita-detail {
            max-width: 950px;
            margin: 0 auto;
        }

        .berita-image {
            width: 100%;
            height: 450px;
            object-fit: cover;
            border-radius: 18px;
        }

        .berita-content {
            background-color: #ffffff;
            border-radius: 18px;
            padding: 40px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
        }

        .berita-content p {
            line-height: 1.9;
            color: #555;
            margin-bottom: 0;
        }

        .btn-biru {
            background-color: #16879a;
            color: white;
            border: none;
        }

        .btn-biru:hover {
            background-color: #126f7e;
            color: white;
        }
    </style>
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">

        <a href="{{ route('home') }}" class="navbar-brand d-flex align-items-center">
            <img
                src="{{ asset('assets/images/logo_mts.png') }}"
                alt="Logo"
                width="45"
                height="45"
                class="me-2"
                style="object-fit: contain;"
            >

            <span>MTS AL-AZHAR</span>
        </a>

        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarMenu"
        >
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarMenu">
            <ul class="navbar-nav ms-auto">

                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link">
                        Beranda
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('home') }}#berita" class="nav-link">
                        Berita
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('login') }}" class="nav-link">
                        Login
                    </a>
                </li>

            </ul>
        </div>

    </div>
</nav>

<div class="container py-5">

    <div class="berita-detail">

        <div class="mb-4">

            <span class="badge bg-info text-white px-3 py-2 rounded-pill mb-3">
                <i class="bi bi-newspaper me-1"></i>
                Berita Sekolah
            </span>

            <h1 class="fw-bold text-dark mb-3">
                {{ $berita->judul }}
            </h1>

            <div class="text-muted">
                <i class="bi bi-calendar3 me-2"></i>
                {{ \Carbon\Carbon::parse($berita->tanggal)->format('d F Y') }}
            </div>

        </div>

        @if($berita->gambar)

            <div class="mb-4">
                <img
                    src="{{ asset('uploads/berita/' . $berita->gambar) }}"
                    alt="{{ $berita->judul }}"
                    class="berita-image"
                >
            </div>

        @else

            <div
                class="bg-white rounded-4 d-flex align-items-center justify-content-center mb-4"
                style="height: 350px;"
            >
                <i class="bi bi-newspaper text-info" style="font-size: 80px;"></i>
            </div>

        @endif

        <div class="berita-content">

            <div class="d-flex align-items-center mb-4">
                <i class="bi bi-info-circle text-info fs-4 me-2"></i>

                <h5 class="fw-bold mb-0">
                    Isi Berita
                </h5>
            </div>

            <p style="white-space: pre-line;">
                {{ $berita->isi }}
            </p>

        </div>

        <div class="mt-4">

            <a
                href="{{ route('home') }}#berita"
                class="btn btn-biru rounded-3 px-4 py-2"
            >
                <i class="bi bi-arrow-left me-2"></i>
                Kembali ke Berita
            </a>

        </div>

    </div>

</div>

<script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

</body>
</html>
