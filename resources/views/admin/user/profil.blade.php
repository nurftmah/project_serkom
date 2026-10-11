@extends('layouts.admin')
@section('title', 'Profil User')
@section('content')

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="mb-1">Profil Akun</h3>
            <p class="text-muted mb-0">Kelola informasi akun yang sedang digunakan</p>
        </div>
        {{-- <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Kembali ke Dashboard</a> --}}
    </div>
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Terjadi kesalahan:</strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="row g-4">
        <div class="col-lg-4">
            <div class="card profile-card border-0 shadow-sm">
                <div class="card-body text-center p-4">
                    <div class="profile-avatar"><i class="bi bi-person-fill"></i></div>
                    <h4 class="mt-3 mb-1">{{ $user->username }}</h4>
                    <div class="mb-3">
                        @if($user->role == 'Admin')
                            <span class="badge bg-success"><i class="bi bi-shield-check me-1"></i>Admin</span>
                        @else
                            <span class="badge bg-success text-dark"><i class="bi bi-person-workspace me-1"></i>Operator</span>
                        @endif
                    </div>
                    <hr>
                    <div class="mt-4 text-start">
                        <div class="d-flex align-items-center gap-3 py-3 border-bottom">
                            <div class="bg-success-subtle text-success rounded-3 p-3">
                                <i class="bi bi-person-circle fs-5"></i>
                            </div>
                            <div class="flex-grow-1">
                                <small class="text-muted d-block mb-1">Username</small>
                                <span class="fw-semibold text-dark">{{ $user->username }}</span>
                            </div>
                        </div>

                        <div class="d-flex align-items-center gap-3 py-3 border-bottom">
                            <div class="bg-success-subtle text-success rounded-3 p-3">
                                <i class="bi bi-shield-check fs-5"></i>
                            </div>
                            <div class="flex-grow-1">
                                <small class="text-muted d-block mb-1">Role</small>
                                @if($user->role == 'Admin')
                                    <span class="badge rounded-pill bg-primary-subtle text-primary px-3 py-2">
                                        <i class="bi bi-shield-check me-1"></i>Admin
                                    </span>
                                @else
                                    <span class="badge rounded-pill bg-success-subtle text-success px-3 py-2">
                                        <i class="bi bi-person-workspace me-1"></i>Operator
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-3 py-3">
                            <div class="bg-success-subtle text-success rounded-3 p-3">
                                <i class="bi bi-calendar3 fs-5"></i>
                            </div>
                            <div class="flex-grow-1">
                                <small class="text-muted d-block mb-1">Bergabung</small>
                                <span class="fw-semibold text-dark">
                                    {{ $user->created_at->format('d-m-Y') }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h5 class="mb-1"><i class="bi bi-person-gear me-2 text-success"></i>Pengaturan Akun</h5>
                    <p class="text-muted mb-4">Ubah username atau password akun kamu.</p>
                    <form action="{{ route('admin.user.profil.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" value="{{ old('username', $user->username) }}" maxlength="30" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Password Baru</label>
                            <div class="password-wrapper">
                                <input type="password" name="password" id="password" class="form-control password-input" placeholder="Kosongkan jika tidak ingin mengubah password">
                                <button type="button" class="password-toggle" onclick="togglePassword('password', 'passwordIcon')"><i class="bi bi-eye" id="passwordIcon"></i></button>
                            </div>
                            <small class="text-muted">Minimal 6 karakter.</small>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Konfirmasi Password Baru</label>
                            <div class="password-wrapper">
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control password-input" placeholder="Ulangi password baru">
                                <button type="button" class="password-toggle" onclick="togglePassword('password_confirmation', 'confirmIcon')"><i class="bi bi-eye" id="confirmIcon"></i></button>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Role</label>
                            <input type="text" class="form-control" value="{{ $user->role }}" disabled>
                            <small class="text-muted">Role akun tidak dapat diubah dari halaman ini.</small>
                        </div>
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-light"><i class="bi bi-arrow-left me-1"></i>Kembali</a>
                            <button type="submit" class="btn btn-green"><i class="bi bi-save me-1"></i>Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
function togglePassword(inputId, iconId) {
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
