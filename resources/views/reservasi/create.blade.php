@extends('layout.master')

@section('content')
    <div class="container mt-3">
        <h2>Tambah Reservasi</h2>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('reservasi.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group mb-3">
                <label>Customer</label>
                <select name="id_customer" class="form-control" required>
                    <option value="">Pilih Customer</option>
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id_customer }}">{{ $customer->nama_customer }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-3">
                <label>Tujuan</label>
                <input type="text" name="tujuan" class="form-control" value="{{ old('tujuan') }}" required>
            </div>

            <div class="form-group mb-3">
                <label>No HP</label>
                <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp') }}" required>
            </div>

            <div class="form-group mb-3">
                <label>Tanggal Reservasi</label>
                <input type="date" name="tanggal_reservasi" class="form-control" value="{{ old('tanggal_reservasi') }}" required>
            </div>

            {{-- <div class="form-group mb-3">
                <label>Nama Paket</label>
                <input type="text" name="nama_paket" class="form-control" value="{{ old('nama_paket') }}" required maxlength="100">
            </div>

            <div class="form-group mb-3">
                <label>Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="3">{{ old('deskripsi') }}</textarea>
            </div>

            <div class="form-group mb-3">
                <label>Harga</label>
                <input type="number" name="harga" class="form-control" value="{{ old('harga') }}" required min="0">
            </div>

            <div class="form-group mb-3">
                <label>Foto</label>
                <input type="file" name="foto" accept="image/*" class="form-control">
            </div>

            <div class="form-group mb-3">
                <label>Status</label>
                <select name="status" class="form-control">
                    <option value="" selected>-- Pilih Status --</option>
                    <option value="1">Aktif</option>
                    <option value="0">Tidak Aktif</option>
                </select>
            </div> --}}

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('reservasi.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection

