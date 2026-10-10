@extends('layouts.admin')
@section('title', 'Data User')
@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="mb-1">Edit Pengelola</h3>
            <p class="text-muted mb-0">Ubah data akun pengelola website sekolah</p>
        </div>
        {{-- <a href="{{ route('admin.user.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i>Kembali
        </a> --}}
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Data belum benar!</strong>
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
                    <h5 class="mb-4"><i class="bi bi-pencil-square text-primary me-2"></i>Form Edit Pengelola</h5>
                    <form action="{{ route('admin.user.update', $user->id) }}" method="POST" autocomplete="off">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" maxlength="30" value="{{ old('username', $user->username) }}" placeholder="Masukkan username" required>
                            <small class="text-muted">Maksimal 30 karakter.</small>
                            @error('username')
                                <small class="text-danger d-block mt-1">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password Baru</label>
                            <div class="input-group">
                                <input type="password" id="password" name="password" class="form-control" placeholder="Kosongkan jika tidak ingin mengubah password" autocomplete="new-password">
                                <button type="button" class="btn btn-outline-secondary toggle-password" data-target="password" aria-label="Tampilkan password">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                            <small class="text-muted">Kosongkan jika password tidak ingin diubah.</small>
                            @error('password')
                                <small class="text-danger d-block mt-1">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Konfirmasi Password Baru</label>
                            <div class="input-group">
                                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Ulangi password baru" autocomplete="new-password">
                                <button type="button" class="btn btn-outline-secondary toggle-password" data-target="password_confirmation" aria-label="Tampilkan konfirmasi password">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Role</label>
                            <select name="role" class="form-select" required>
                                <option value="Admin" {{ old('role', $user->role) == 'Admin' ? 'selected' : '' }}>Admin</option>
                                <option value="Operator" {{ old('role', $user->role) == 'Operator' ? 'selected' : '' }}>Operator</option>
                            </select>
                            @error('role')
                                <small class="text-danger d-block mt-1">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.user.index') }}" class="btn btn-light">Batal</a>
                            <button type="submit" class="btn btn-green">
                                <i class="bi bi-save me-1"></i>Simpan Perubahan
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
                    <h5 class="text-center mb-3">Informasi Akun</h5>
                    <div class="info-item mb-3">
                        <span class="text-muted">Username</span>
                        <strong>{{ $user->username }}</strong>
                    </div>
                    <div class="info-item mb-3">
                        <span class="text-muted">Role</span>
                        @if($user->role == 'Admin')
                            <span class="badge bg-primary">Admin</span>
                        @else
                            <span class="badge bg-info text-dark">Operator</span>
                        @endif
                    </div>
                    <hr>
                    <p class="text-muted small mb-0">
                        <i class="bi bi-info-circle me-1"></i>
                        Jika password tidak ingin diubah, biarkan kolom password tetap kosong.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
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
