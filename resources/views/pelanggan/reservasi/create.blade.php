@extends('layout.app')

@section('content')
<div class="container mt-4">
    <h3>Form Reservasi</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('reservasi.pelanggan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="nama_customer" class="form-label">Nama Lengkap</label>
            <input type="text" name="nama_customer" id="nama_customer" class="form-control" value="{{ old('nama_customer') }}" required>
            @error('nama_customer')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="no_hp" class="form-label">Nomor HP</label>
            <input type="text" name="no_hp" id="no_hp" class="form-control" value="{{ old('no_hp') }}" required>
            @error('no_hp')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="tujuan" class="form-label">Tujuan</label>
            <input type="text" name="tujuan" id="tujuan" class="form-control" value="{{ old('tujuan') }}">
            @error('tujuan')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="tanggal_reservasi" class="form-label">Tanggal Reservasi</label>
            <input type="date" name="tanggal_reservasi" id="tanggal_reservasi" class="form-control" value="{{ old('tanggal_reservasi') }}" required>
            @error('tanggal_reservasi')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="bukti_pembayaran" class="form-label">Bukti Pembayaran (Opsional)</label>
            <input type="file" name="bukti_pembayaran" id="bukti_pembayaran" class="form-control">
            @error('bukti_pembayaran')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Kirim Reservasi</button>
    </form>
</div>
@endsection
