@extends('layout.master')


@section('content')
<div class="container mt-3">
    <h2>Edit Reservasi</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('reservasi.update', $reservasi->id_reservasi) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label for="id_customer">Customer</label>
            <select name="id_customer" class="form-control">
                <option value="">-- Pilih Customer --</option>
                @foreach($customers as $customer)
                    <option value="{{ $customer->id_customer }}" {{ old('id_customer', $reservasi->id_customer) == $customer->id_customer ? 'selected' : '' }}>
                        {{ $customer->nama_customer }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="nama_customer">Nama Customer</label>
            <input type="text" name="nama_customer" class="form-control" value="{{ old('nama_customer', $reservasi->nama_customer) }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="tujuan">Tujuan</label>
            <input type="text" name="tujuan" class="form-control" value="{{ old('tujuan', $reservasi->tujuan) }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="no_hp">No HP</label>
            <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp', $reservasi->no_hp) }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="tanggal_reservasi">Tanggal Reservasi</label>
            <input type="date" name="tanggal_reservasi" class="form-control" value="{{ old('tanggal_reservasi', $reservasi->tanggal_reservasi->format('Y-m-d')) }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="bukti_pembayaran">Bukti Pembayaran (opsional)</label><br>
            @if($reservasi->bukti_pembayaran)
                <a href="{{ asset('storage/' . $reservasi->bukti_pembayaran) }}" target="_blank">Lihat file saat ini</a><br><br>
            @endif
            <input type="file" name="bukti_pembayaran" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('reservasi.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
