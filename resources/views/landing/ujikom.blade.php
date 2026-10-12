@extends('layouts.landing')
@section('title', 'Ujikom')
@section('content')
<div class="container py-4">
    <h3>Ujikom</h3>
    <hr>

    <form action="{{ route('landing.ujikom.hitung') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Barang 1</label>
            <input type="text" name="barang1" class="form-control" value="{{ old('barang1', $request->barang1 ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Harga Barang 1</label>
            <input type="number" name="harga1" class="form-control" value="{{ old('harga1', $request->harga1 ?? '') }}" min="0" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Barang 2</label>
            <input type="text" name="barang2" class="form-control" value="{{ old('barang2', $request->barang2 ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Harga Barang 2</label>
            <input type="number" name="harga2" class="form-control" value="{{ old('harga2', $request->harga2 ?? '') }}" min="0" required>
        </div>

        <button type="submit" class="btn btn-primary">Hitung Total</button>
    </form>

    @if ($errors->any())
        <div class="alert alert-danger mt-3">
            @foreach ($errors->all() as $error)
                <p class="mb-0">{{ $error }}</p>
            @endforeach
        </div>
    @endif

    @isset($total)
        <hr>
        <h5>Hasil Perhitungan</h5>
        <p>Barang 1: {{ $request->barang1 }}</p>
        <p>Harga Barang 1: Rp{{ number_format($request->harga1, 0, ',', '.') }}</p>
        <p>Barang 2: {{ $request->barang2 }}</p>
        <p>Harga Barang 2: Rp{{ number_format($request->harga2, 0, ',', '.') }}</p>
        <h5>Total Harga: Rp{{ number_format($total, 0, ',', '.') }}</h5>
        <p><strong>{{ $hadiah }}</strong></p>
    @endisset
</div>
@endsection
