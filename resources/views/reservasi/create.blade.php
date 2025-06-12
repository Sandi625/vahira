@extends('layout.master')

@section('content')
<div class="container mt-3">
    <h2>Tambah Reservasi</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('reservasi.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group mb-3">
            <label for="id_customer">Customer</label>
            <select name="id_customer" class="form-control" required>
                <option value="">-- Pilih Customer --</option>
                @foreach($customers as $customer)
                    <option value="{{ $customer->id_customer }}" {{ old('id_customer') == $customer->id_customer ? 'selected' : '' }}>
                        {{ $customer->nama_customer }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="nama_customer">Nama Customer</label>
            <input type="text" name="nama_customer" class="form-control" value="{{ old('nama_customer') }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="tujuan">Tujuan</label>
            <input type="text" name="tujuan" class="form-control" value="{{ old('tujuan') }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="no_hp">No HP</label>
            <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp') }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="tanggal_reservasi">Tanggal Reservasi</label>
            <input type="date" name="tanggal_reservasi" class="form-control" value="{{ old('tanggal_reservasi') }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="bukti_pembayaran">Bukti Pembayaran (opsional)</label>
            <input type="file" name="bukti_pembayaran" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('reservasi.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection

