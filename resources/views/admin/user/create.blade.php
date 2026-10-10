@extends('layouts.admin')
@section('title', 'Data User')
@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="mb-1">Tambah Pengelola</h3>
            <p class="text-muted mb-0">Tambahkan akun pengelola website sekolah</p>
        </div>
        {{-- <a href="{{ route('admin.user.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i>Kembali
        </a> --}}
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Terjadi kesalahan!</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="row">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h5 class="mb-4"><i class="bi bi-person-plus text-primary me-2"></i>Form Data Pengelola</h5>
                    <form action="{{ route('admin.user.store') }}" method="POST" autocomplete="off">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" maxlength="30" value="{{ old('username') }}" placeholder="Masukkan username" autocomplete="off" required>
                            <small class="text-muted">Maksimal 30 karakter.</small>
                            @error('username')
                                <small class="text-danger d-block mt-1">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <div class="input-group">
                                <input type="password" id="password" name="password" class="form-control" placeholder="Masukkan password" autocomplete="new-password" required>
                                <button type="button" class="btn btn-outline-secondary toggle-password" data-target="password" aria-label="Tampilkan password">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                            @error('password')
                                <small class="text-danger d-block mt-1">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Konfirmasi Password</label>
                            <div class="input-group">
                                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Ulangi password" autocomplete="new-password" required>
                                <button type="button" class="btn btn-outline-secondary toggle-password" data-target="password_confirmation" aria-label="Tampilkan konfirmasi password">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Role</label>
                            <select name="role" class="form-select" required>
                                <option value="">-- Pilih Role --</option>
                                <option value="Admin" {{ old('role') == 'Admin' ? 'selected' : '' }}>Admin</option>
                                <option value="Operator" {{ old('role') == 'Operator' ? 'selected' : '' }}>Operator</option>
                            </select>
                            @error('role')
                                <small class="text-danger d-block mt-1">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.user.index') }}" class="btn btn-light">Batal</a>
                            <button type="submit" class="btn btn-green">
                                <i class="bi bi-save me-1"></i>Simpan Pengelola
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="text-center mb-3">
                        <div class="user-info-icon"><i class="bi bi-person-gear"></i></div>
                    </div>
                    <h5 class="text-center mb-3">Informasi Pengelola</h5>
                    <p class="text-muted small">Akun pengelola digunakan untuk masuk ke halaman administrator website sekolah.</p>
                    <hr>
                    <div class="mb-3">
                        <strong><i class="bi bi-shield-check me-2 text-primary"></i>Admin</strong>
                        <p class="text-muted small mb-0 mt-1">Memiliki akses untuk mengelola sistem dan data website sekolah.</p>
                    </div>
                    <div>
                        <strong><i class="bi bi-person-workspace me-2 text-primary"></i>Operator</strong>
                        <p class="text-muted small mb-0 mt-1">Membantu mengelola data website sekolah.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
.card{border-radius:15px}
.form-label{font-weight:600;color:#34495e}
.form-control,.form-select{border-radius:8px;padding:10px 13px}
.input-group .form-control{border-radius:8px 0 0 8px}
.input-group .toggle-password{border-radius:0 8px 8px 0;padding:10px 14px;min-width:48px}
.form-control:focus,.form-select:focus{border-color:#1595a8;box-shadow:0 0 0 .2rem rgba(21,149,168,.15)}
.btn-primary{background:#1595a8;border-color:#1595a8;border-radius:8px;padding:9px 16px}
.btn-primary:hover{background:#117f90;border-color:#117f90}
.user-info-icon{width:70px;height:70px;border-radius:50%;background:#e3f6fa;color:#1595a8;display:inline-flex;align-items:center;justify-content:center;font-size:30px}
.toggle-password i{font-size:17px}
</style>
<script>
document.querySelectorAll('.toggle-password').forEach(function(button){
    button.addEventListener('click',function(){
        const password=document.getElementById(this.dataset.target);
        const icon=this.querySelector('i');
        const isHidden=password.type==='password';
        password.type=isHidden?'text':'password';
        icon.classList.toggle('bi-eye',!isHidden);
        icon.classList.toggle('bi-eye-slash',isHidden);
        this.setAttribute('aria-label',isHidden?'Sembunyikan password':'Tampilkan password');
    });
});
</script>
@endsection
