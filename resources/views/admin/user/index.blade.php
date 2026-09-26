@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h3 class="mb-1">Pengelola Web</h3>

            <p class="text-muted mb-0">
                Kelola akun admin dan operator website sekolah
            </p>
        </div>

        <a href="{{ route('admin.user.create') }}" class="btn btn-primary">
            <i class="bi bi-person-plus-fill me-1"></i>
            Tambah Pengelola
        </a>

    </div>


    <!-- PESAN SUKSES -->
    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show" role="alert">

            <i class="bi bi-check-circle me-2"></i>

            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>

        </div>

    @endif


    <!-- INFO CARD -->
    <div class="row g-4 mb-4">

        <!-- TOTAL PENGELOLA -->
        <div class="col-md-4">

            <div class="operator-info-card">

                <div class="operator-icon">
                    <i class="bi bi-people-fill"></i>
                </div>

                <div>

                    <div class="operator-label">
                        Total Pengelola
                    </div>

                    <div class="operator-number">
                        {{ $totalUser }}
                    </div>

                </div>

            </div>

        </div>


        <!-- ADMIN -->
        <div class="col-md-4">

            <div class="operator-info-card">

                <div class="operator-icon">
                    <i class="bi bi-shield-check"></i>
                </div>

                <div>

                    <div class="operator-label">
                        Admin
                    </div>

                    <div class="operator-number">
                        {{ $totalAdmin }}
                    </div>

                </div>

            </div>

        </div>


        <!-- OPERATOR -->
        <div class="col-md-4">

            <div class="operator-info-card">

                <div class="operator-icon">
                    <i class="bi bi-person-workspace"></i>
                </div>

                <div>

                    <div class="operator-label">
                        Operator
                    </div>

                    <div class="operator-number">
                        {{ $totalOperator }}
                    </div>

                </div>

            </div>

        </div>

    </div>


    <!-- TABLE -->
    <div class="card border-0 shadow-sm">

        <!-- CARD HEADER -->
        <div class="card-header bg-white border-0 py-3">

            <div>

                <h5 class="mb-1">

                    <i class="bi bi-person-gear text-primary me-2"></i>

                    Daftar Pengelola Web

                </h5>

                <small class="text-muted">
                    Akun yang memiliki akses ke halaman administrator
                </small>

            </div>

        </div>


        <!-- CARD BODY -->
        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="table-light">

                        <tr>

                            <th class="px-4">
                                No
                            </th>

                            <th>
                                Username
                            </th>

                            <th>
                                Level
                            </th>

                            <th>
                                Status
                            </th>

                            <th class="text-center">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse($users as $user)

                            <tr>

                                <!-- NO -->
                                <td class="px-4">
                                    {{ $loop->iteration }}
                                </td>


                                <!-- USERNAME -->
                                <td>

                                    <strong>
                                        {{ $user->username }}
                                    </strong>

                                </td>


                                <!-- LEVEL -->
                                <td>

                                    @if($user->role == 'Admin')

                                        <span class="badge bg-primary">
                                            <i class="bi bi-shield-check me-1"></i>
                                            Admin
                                        </span>

                                    @elseif($user->role == 'Operator')

                                        <span class="badge bg-info text-dark">
                                            <i class="bi bi-person-workspace me-1"></i>
                                            Operator
                                        </span>

                                    @endif

                                </td>


                                <!-- STATUS -->
                                <td>

                                    <span class="badge bg-success">
                                        Aktif
                                    </span>

                                </td>


                                <!-- AKSI -->
                                <td class="text-center">

                                    <!-- EDIT -->
                                    <a href="{{ route('admin.user.edit', $user->id) }}"
                                       class="btn btn-sm btn-warning"
                                       title="Edit">

                                        <i class="bi bi-pencil"></i>

                                    </a>


                                    <!-- HAPUS -->
                                    <form action="{{ route('admin.user.destroy', $user->id) }}"
                                          method="POST"
                                          class="d-inline">

                                        @csrf

                                        @method('DELETE')

                                        <button type="submit"
                                                class="btn btn-sm btn-danger"
                                                title="Hapus"
                                                onclick="return confirm('Yakin ingin menghapus akun {{ $user->username }}?')">

                                            <i class="bi bi-trash"></i>

                                        </button>

                                    </form>

                                </td>

                            </tr>


                        @empty

                            <!-- DATA KOSONG -->
                            <tr>

                                <td colspan="5" class="text-center py-5">

                                    <div class="mb-3">

                                        <i class="bi bi-person-gear"
                                           style="font-size: 50px; color: #b8c2cc;">
                                        </i>

                                    </div>

                                    <h6 class="mb-1">
                                        Belum ada pengelola
                                    </h6>

                                    <p class="text-muted mb-3">
                                        Belum ada akun pengelola website yang ditambahkan.
                                    </p>

                                    <a href="{{ route('admin.user.create') }}"
                                       class="btn btn-primary btn-sm">

                                        <i class="bi bi-person-plus-fill me-1"></i>

                                        Tambah Pengelola

                                    </a>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>


<style>

    /* INFO CARD */
    .operator-info-card {
        background: #ffffff;
        border-radius: 15px;
        padding: 20px;

        display: flex;
        align-items: center;

        gap: 15px;

        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    }


    /* ICON */
    .operator-icon {
        width: 50px;
        height: 50px;

        border-radius: 12px;

        background: #e3f6fa;
        color: #1595a8;

        display: flex;
        align-items: center;
        justify-content: center;

        font-size: 22px;
    }


    /* LABEL */
    .operator-label {
        color: #7b8794;
        font-size: 13px;

        margin-bottom: 3px;
    }


    /* NUMBER */
    .operator-number {
        font-size: 25px;
        font-weight: 700;

        color: #1f2937;
    }


    /* CARD */
    .card {
        border-radius: 15px;
        overflow: hidden;
    }


    /* TABLE */
    .table th {
        font-size: 13px;
        font-weight: 600;

        color: #566573;

        white-space: nowrap;
    }


    .table td {
        font-size: 14px;

        color: #34495e;
    }


    /* BUTTON */
    .btn-primary {
        background: #1595a8;
        border-color: #1595a8;

        border-radius: 8px;

        padding: 9px 16px;
    }


    .btn-primary:hover {
        background: #117f90;
        border-color: #117f90;
    }

</style>

@endsection
