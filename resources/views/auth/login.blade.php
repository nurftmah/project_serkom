<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $profil?->nama_sekolah ?? 'MTS AL-AZHAR' }} | Login</title>

    <link rel="icon"
          type="image/png"
          href="{{ $profil?->logo
              ? asset('uploads/profil/' . $profil->logo)
              : asset('assets/images/logo_mts.png') }}">

    <!-- Bootstrap -->
    <link rel="stylesheet"
          href="{{ asset('assets/libs/bootstrap/css/bootstrap.min.css') }}">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet"
          href="{{ asset('assets/libs/bootstrap-icons/bootstrap-icons.css') }}">

    <!-- Main CSS Template -->
    <link rel="stylesheet"
          href="{{ asset('assets/css/main.css') }}">

</head>


<body>


<div class="login-wrapper">

    <!-- BACKGROUND SHAPE -->

    <div class="login-bg-shape login-bg-shape-1"></div>

    <div class="login-bg-shape login-bg-shape-2"></div>


    <!-- LOGIN CARD -->

    <div class="login-card">


        <!-- BRAND -->
        <div class="login-brand d-flex align-items-center justify-content-center gap-2">

            <div class="ratio ratio-1x1" style="width: 70px;">
                <img
                    src="{{ $profil?->logo
                        ? asset('uploads/profil/' . $profil->logo)
                        : asset('assets/images/logo_mts.png') }}"
                    alt="{{ $profil?->nama_sekolah ?? 'Logo Sekolah' }}"
                    class="img-fluid object-fit-contain"
                >
            </div>

            <span class="fw-semibold text-success">
                {{ $profil?->nama_sekolah ?? 'MTS AL-AZHAR' }}
            </span>

        </div>


        <!-- TITLE -->

        <h1 class="login-title">
            Selamat Datang
        </h1>


        <p class="login-subtitle">
            Silakan masuk untuk mengelola website sekolah
        </p>


        <!-- ERROR -->

        @if ($errors->any())

            <div class="alert alert-danger">

                <i class="bi bi-exclamation-circle me-2"></i>

                {{ $errors->first() }}

            </div>

        @endif


        <!-- SUCCESS -->

        @if (session('success'))

            <div class="alert alert-success">

                <i class="bi bi-check-circle me-2"></i>

                {{ session('success') }}

            </div>

        @endif


        <!-- FORM -->

        <form action="{{ route('login') }}" method="POST">

            @csrf


            <!-- USERNAME -->

            <div class="login-form-group">

                <label class="login-form-label">
                    Username
                </label>

                <div class="login-input-group">

                    <i class="bi bi-person input-icon"></i>

                    <input
                        type="text"
                        name="username"
                        class="login-input"
                        placeholder="Masukkan username"
                        value="{{ old('username') }}"
                        autocomplete="username"
                        required
                    >

                </div>

            </div>


            <!-- PASSWORD -->

            <div class="login-form-group">

                <label class="login-form-label">
                    Password
                </label>

                <div class="login-input-group">

                    <i class="bi bi-lock input-icon"></i>

                    <input
                        type="password"
                        name="password"
                        id="password"
                        class="login-input login-input-password"
                        placeholder="Masukkan password"
                        autocomplete="current-password"
                        required
                    >


                    <!-- TOGGLE PASSWORD -->

                    <button
                        type="button"
                        class="password-toggle-btn"
                        onclick="togglePassword()"
                    >

                        <i
                            class="bi bi-eye"
                            id="passwordIcon"
                        ></i>

                    </button>

                </div>

            </div>


            <!-- BUTTON -->

            <button
                type="submit"
                class="btn btn-success w-100"
                style="
                    /* background:#1595a8;
                    border-color:#1595a8; */
                    border-radius:10px;
                    padding:12px;
                    font-weight:600;
                "
            >

                <i class="bi bi-box-arrow-in-right me-2"></i>

                Masuk

            </button>


        </form>


        <!-- FOOTER -->

        <div class="text-center mt-4">

            <small class="text-muted">

                {{ $profil?->nama_sekolah ?? 'SchoolHub' }}

            </small>

        </div>


    </div>

</div>


<!-- PASSWORD SCRIPT -->

<script>

function togglePassword() {

    const password =
        document.getElementById('password');

    const icon =
        document.getElementById('passwordIcon');


    if (password.type === 'password') {

        password.type = 'text';

        icon.classList.remove('bi-eye');

        icon.classList.add('bi-eye-slash');

    } else {

        password.type = 'password';

        icon.classList.remove('bi-eye-slash');

        icon.classList.add('bi-eye');

    }

}

</script>


</body>

</html>
