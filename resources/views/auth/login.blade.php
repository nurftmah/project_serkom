<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8"> <!-- Mengatur karakter teks -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Menyesuaikan tampilan dengan ukuran layar -->

    <title>{{ $profil?->nama_sekolah ?? 'MTS AL-AZHAR' }} | Login</title> <!-- Judul halaman login -->

    <link rel="icon" type="image/png"
        href="{{ $profil?->logo ? asset('storage/profil/' . $profil->logo) : asset('assets/images/logo_mts.png') }}"> <!-- Menampilkan logo sekolah pada tab browser -->

    <link rel="stylesheet" href="{{ asset('assets/libs/bootstrap/css/bootstrap.min.css') }}"> <!-- Memanggil CSS Bootstrap -->
    <link rel="stylesheet" href="{{ asset('assets/libs/bootstrap-icons/bootstrap-icons.css') }}"> <!-- Memanggil ikon Bootstrap -->
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}"> <!-- Memanggil CSS utama -->
</head>
<body>
<div class="login-wrapper"> <!-- Pembungkus seluruh tampilan login -->
    <div class="login-bg-shape login-bg-shape-1"></div> <!-- Hiasan latar belakang pertama -->
    <div class="login-bg-shape login-bg-shape-2"></div> <!-- Hiasan latar belakang kedua -->

    <div class="login-card"> <!-- Kotak utama login -->
        <div class="login-brand d-flex align-items-center justify-content-center gap-2"> <!-- Bagian logo dan nama sekolah -->
            <div class="ratio ratio-1x1" style="width: 70px;"> <!-- Mengatur ukuran logo agar berbentuk persegi -->
                <img src="{{ $profil?->logo ? asset('storage/profil/' . $profil->logo) : asset('assets/images/logo_mts.png') }}"
                    alt="{{ $profil?->nama_sekolah ?? 'Logo Sekolah' }}"
                    class="img-fluid object-fit-contain"> <!-- Menampilkan logo sekolah -->
            </div>
            <span class="fw-semibold text-success">
                {{ $profil?->nama_sekolah ?? 'MTS AL-AZHAR' }} <!-- Menampilkan nama sekolah dari database -->
            </span>
        </div>

        <h1 class="login-title">Selamat Datang</h1> <!-- Judul halaman login -->
        <p class="login-subtitle">Silakan masuk untuk mengelola website sekolah</p> <!-- Keterangan login -->

        @if ($errors->any()) <!-- Memeriksa apakah terdapat kesalahan login -->
            <div class="alert alert-danger">
                <i class="bi bi-exclamation-circle me-2"></i>
                {{ $errors->first() }} <!-- Menampilkan pesan kesalahan -->
            </div>
        @endif

        @if (session('success')) <!-- Memeriksa apakah terdapat pesan berhasil -->
            <div class="alert alert-success">
                <i class="bi bi-check-circle me-2"></i>
                {{ session('success') }} <!-- Menampilkan pesan berhasil -->
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST"> <!-- Form untuk mengirim data login -->
            @csrf <!-- Melindungi form dari permintaan palsu -->

            <div class="login-form-group"> <!-- Bagian input username -->
                <label class="login-form-label">Username</label> <!-- Label username -->
                <div class="login-input-group">
                    <i class="bi bi-person input-icon"></i> <!-- Ikon pengguna -->
                    <input type="text" name="username" class="login-input"
                        placeholder="Masukkan username"
                        value="{{ old('username') }}"
                        autocomplete="username" required> <!-- Input username -->
                </div>
            </div>

            <div class="login-form-group"> <!-- Bagian input password -->
                <label class="login-form-label">Password</label> <!-- Label password -->
                <div class="login-input-group">
                    <i class="bi bi-lock input-icon"></i> <!-- Ikon gembok -->
                    <input type="password" name="password" id="password"
                        class="login-input login-input-password"
                        placeholder="Masukkan password"
                        autocomplete="current-password" required> <!-- Input password yang disembunyikan -->

                    <button type="button" class="password-toggle-btn"
                        onclick="togglePassword()"> <!-- Tombol untuk menampilkan atau menyembunyikan password -->
                        <i class="bi bi-eye" id="passwordIcon"></i> <!-- Ikon mata -->
                    </button>
                </div>
            </div>

            <button type="submit" class="btn btn-success w-100"
                style="border-radius:10px; padding:12px; font-weight:600;"> <!-- Tombol untuk mengirim form -->
                <i class="bi bi-box-arrow-in-right me-2"></i>
                Masuk
            </button>
        </form>

        <div class="text-center mt-4"> <!-- Bagian bawah halaman login -->
            <small class="text-muted">
                {{ $profil?->nama_sekolah ?? 'MTS AL-AZHAR' }} <!-- Menampilkan nama sekolah -->
            </small>
        </div>
    </div>
</div>

<script>
function togglePassword() { // Fungsi untuk mengatur tampilan password
    const password = document.getElementById('password'); // Mengambil elemen input password
    const icon = document.getElementById('passwordIcon'); // Mengambil elemen ikon mata

    if (password.type === 'password') { // Memeriksa apakah password sedang tersembunyi
        password.type = 'text'; // Menampilkan password
        icon.classList.remove('bi-eye'); // Menghapus ikon mata terbuka
        icon.classList.add('bi-eye-slash'); // Mengganti dengan ikon mata tertutup
    } else {
        password.type = 'password'; // Menyembunyikan password
        icon.classList.remove('bi-eye-slash'); // Menghapus ikon mata tertutup
        icon.classList.add('bi-eye'); // Mengembalikan ikon mata terbuka
    }
}
</script>
</body>
</html>
