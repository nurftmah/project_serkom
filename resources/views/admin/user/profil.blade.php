@extends('layouts.admin')
@section('title', 'Profil User')
@section('content')

<div class="container-fluid">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h3 class="mb-1">
                Profil Akun
            </h3>

            <p class="text-muted mb-0">
                Kelola informasi akun yang sedang digunakan
            </p>
        </div>

        <!-- KEMBALI KE DASHBOARD -->
        <a href="{{ route('admin.dashboard') }}"
           class="btn btn-outline-secondary">

            <i class="bi bi-arrow-left me-1"></i>

            Kembali ke Dashboard

        </a>

    </div>


    <!-- PESAN BERHASIL -->
    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show">

            <i class="bi bi-check-circle me-2"></i>

            {{ session('success') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert">
            </button>

        </div>

    @endif


    <!-- ERROR -->
    @if($errors->any())

        <div class="alert alert-danger">

            <strong>Terjadi kesalahan:</strong>

            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>
                        {{ $error }}
                    </li>
                @endforeach
            </ul>

        </div>

    @endif


    <div class="row g-4">


        <!-- ================================= -->
        <!-- KARTU PROFIL -->
        <!-- ================================= -->

        <div class="col-lg-4">

            <div class="card profile-card border-0 shadow-sm">

                <div class="card-body text-center p-4">
                    <!-- ICON PROFIL -->

                    <div class="profile-avatar">
                        <i class="bi bi-person-fill"></i>
                    </div>


                    <!-- USERNAME -->

                    <h4 class="mt-3 mb-1">
                        {{ $user->username }}
                    </h4>


                    <!-- ROLE -->

                    <div class="mb-3">

                        @if($user->role == 'Admin')
                            <span class="badge bg-primary">
                                <i class="bi bi-shield-check me-1"></i>
                                Admin
                            </span>
                        @else
                            <span class="badge bg-info text-dark">
                                <i class="bi bi-person-workspace me-1"></i>
                                Operator
                            </span>
                        @endif

                    </div>


                    <hr>


                    <!-- INFORMASI AKUN -->

                    <div class="profile-info">


                        <!-- USERNAME -->

                        <div class="info-item">

                            <i class="bi bi-person-circle"></i>

                            <div>

                                <small>
                                    Username
                                </small>

                                <strong>
                                    {{ $user->username }}
                                </strong>

                            </div>

                        </div>


                        <!-- ROLE -->

                        <div class="info-item">

                            <i class="bi bi-shield-check"></i>

                            <div>

                                <small>
                                    Role
                                </small>

                                <strong>
                                    {{ $user->role }}
                                </strong>

                            </div>

                        </div>


                        <!-- TANGGAL BERGABUNG -->

                        <div class="info-item">

                            <i class="bi bi-calendar3"></i>

                            <div>

                                <small>
                                    Bergabung
                                </small>

                                <strong>
                                    {{ $user->created_at->format('d-m-Y') }}
                                </strong>

                            </div>

                        </div>


                    </div>

                </div>

            </div>

        </div>


        <!-- ================================= -->
        <!-- FORM PENGATURAN AKUN -->
        <!-- ================================= -->

        <div class="col-lg-8">

            <div class="card border-0 shadow-sm">

                <div class="card-body p-4">


                    <h5 class="mb-1">

                        <i class="bi bi-person-gear me-2 text-primary"></i>

                        Pengaturan Akun

                    </h5>


                    <p class="text-muted mb-4">

                        Ubah username atau password akun kamu.

                    </p>


                    <form
                        action="{{ route('admin.user.profil.update') }}"
                        method="POST"
                    >

                        @csrf

                        @method('PUT')


                        <!-- ================================= -->
                        <!-- USERNAME -->
                        <!-- ================================= -->

                        <div class="mb-4">

                            <label class="form-label">
                                Username
                            </label>

                            <input
                                type="text"
                                name="username"
                                class="form-control"
                                value="{{ old('username', $user->username) }}"
                                maxlength="30"
                                required
                            >

                        </div>


                        <!-- ================================= -->
                        <!-- PASSWORD BARU -->
                        <!-- ================================= -->

                        <div class="mb-4">

                            <label class="form-label">
                                Password Baru
                            </label>


                            <div class="password-wrapper">

                                <input
                                    type="password"
                                    name="password"
                                    id="password"
                                    class="form-control password-input"
                                    placeholder="Kosongkan jika tidak ingin mengubah password"
                                >


                                <!-- TOMBOL MATA -->

                                <button
                                    type="button"
                                    class="password-toggle"
                                    onclick="togglePassword('password', 'passwordIcon')"
                                >

                                    <i
                                        class="bi bi-eye"
                                        id="passwordIcon"
                                    ></i>

                                </button>

                            </div>


                            <small class="text-muted">

                                Minimal 6 karakter.

                            </small>

                        </div>


                        <!-- ================================= -->
                        <!-- KONFIRMASI PASSWORD -->
                        <!-- ================================= -->

                        <div class="mb-4">

                            <label class="form-label">

                                Konfirmasi Password Baru

                            </label>


                            <div class="password-wrapper">

                                <input
                                    type="password"
                                    name="password_confirmation"
                                    id="password_confirmation"
                                    class="form-control password-input"
                                    placeholder="Ulangi password baru"
                                >


                                <!-- TOMBOL MATA -->

                                <button
                                    type="button"
                                    class="password-toggle"
                                    onclick="togglePassword('password_confirmation', 'confirmIcon')"
                                >

                                    <i
                                        class="bi bi-eye"
                                        id="confirmIcon"
                                    ></i>

                                </button>

                            </div>

                        </div>


                        <!-- ================================= -->
                        <!-- ROLE -->
                        <!-- ================================= -->

                        <div class="mb-4">

                            <label class="form-label">
                                Role
                            </label>


                            <input
                                type="text"
                                class="form-control"
                                value="{{ $user->role }}"
                                disabled
                            >


                            <small class="text-muted">

                                Role akun tidak dapat diubah dari halaman ini.

                            </small>

                        </div>


                        <!-- ================================= -->
                        <!-- BUTTON -->
                        <!-- ================================= -->

                        <div class="d-flex justify-content-end gap-2">


                            <!-- KEMBALI -->

                            <a
                                href="{{ route('admin.dashboard') }}"
                                class="btn btn-light"
                            >

                                <i class="bi bi-arrow-left me-1"></i>

                                Kembali

                            </a>


                            <!-- SIMPAN -->

                            <button
                                type="submit"
                                class="btn btn-green"
                            >

                                <i class="bi bi-save me-1"></i>

                                Simpan Perubahan

                            </button>

                        </div>


                    </form>

                </div>

            </div>

        </div>

    </div>

</div>


<!-- ========================================= -->
<!-- JAVASCRIPT PASSWORD -->
<!-- ========================================= -->

<script>

function togglePassword(inputId, iconId)
{
    const input = document.getElementById(inputId);

    const icon = document.getElementById(iconId);


    if (input.type === "password") {

        input.type = "text";

        icon.classList.remove("bi-eye");

        icon.classList.add("bi-eye-slash");

    } else {

        input.type = "password";

        icon.classList.remove("bi-eye-slash");

        icon.classList.add("bi-eye");

    }
}

</script>

@endsection
