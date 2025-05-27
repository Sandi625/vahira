@extends('layout.master')

@section('content')
    <div class="container mt-3">
        <h2>Edit Pembayaran</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('pembayaran.update', $pembayaran->id_pembayaran) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group mb-3">
                <label>Reservasi</label>
                <select name="id_reservasi" class="form-control" required>
                    <option value="">Pilih Reservasi</option>
                    @foreach ($reservasis as $reservasi)
                        <option value="{{ $reservasi->id_reservasi }}"
                            {{ $pembayaran->id_reservasi == $reservasi->id_reservasi ? 'selected' : '' }}>
                            {{ $reservasi->customer->nama_customer ?? '-' }} - {{ $reservasi->tujuan }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-3">
                <label>Jumlah Pembayaran</label>
                <input type="number" name="jumlah_pembayaran" class="form-control"
                    value="{{ $pembayaran->jumlah_pembayaran }}" required>
            </div>
            <div class="form-group mb-3">
                <label>Metode Pembayaran</label>
                <select name="metode_pembayaran" class="form-control" required>
                    <option value="">-- Pilih Metode --</option>
                    <option value="CASH"
                        {{ old('metode_pembayaran', $pembayaran->metode_pembayaran ?? '') == 'CASH' ? 'selected' : '' }}>
                        CASH</option>
                    <option value="TRANSFER"
                        {{ old('metode_pembayaran', $pembayaran->metode_pembayaran ?? '') == 'TRANSFER' ? 'selected' : '' }}>
                        TRANSFER</option>
                </select>
            </div>

            <div class="form-group mb-3">
                <label>Status Pembayaran</label>
                <select name="status_pembayaran" class="form-control" required>
                    <option value="">-- Pilih Status --</option>
                    <option value="DITERIMA" {{ $pembayaran->status_pembayaran == 'DITERIMA' ? 'selected' : '' }}>DITERIMA
                    </option>
                    <option value="TIDAK DITERIMA"
                        {{ $pembayaran->status_pembayaran == 'TIDAK DITERIMA' ? 'selected' : '' }}>TIDAK DITERIMA</option>
                </select>
            </div>

            <div class="form-group mb-3">
                <label>Tanggal Pembayaran</label>
                <input type="date" name="tanggal_pembayaran" class="form-control"
                    value="{{ $pembayaran->tanggal_pembayaran }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('pembayaran.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection
