@extends('layout.master')

@section('content')
    <div class="container mt-3">
        <h2>Edit Reservasi</h2>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
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
                <label>Customer</label>
                <select name="id_customer" class="form-control" required>
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id_customer }}" {{ $reservasi->id_customer == $customer->id_customer ? 'selected' : '' }}>
                            {{ $customer->nama_customer }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-3">
                <label>Tujuan</label>
                <input type="text" name="tujuan" class="form-control" value="{{ old('tujuan', $reservasi->tujuan) }}" required>
            </div>

            <div class="form-group mb-3">
                <label>No HP</label>
                <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp', $reservasi->no_hp) }}" required>
            </div>

            <div class="form-group mb-3">
                <label>Tanggal Reservasi</label>
                <input type="date" name="tanggal_reservasi" class="form-control" value="{{ old('tanggal_reservasi', $reservasi->tanggal_reservasi->format('Y-m-d')) }}" required>
            </div>

            {{-- <div class="form-group mb-3">
                <label>Nama Paket</label>
                <input type="text" name="nama_paket" class="form-control" value="{{ old('nama_paket', $reservasi->nama_paket) }}" required maxlength="100">
            </div>

            <div class="form-group mb-3">
                <label>Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="3">{{ old('deskripsi', $reservasi->deskripsi) }}</textarea>
            </div>

            <div class="form-group mb-3">
                <label>Harga</label>
                <input type="number" name="harga" class="form-control" value="{{ old('harga', $reservasi->harga) }}" required min="0">
            </div>

            <div class="form-group mb-3">
                <label>Foto</label><br>
                @if($reservasi->foto)
                    <img src="{{ asset('uploads/reservasi/' . $reservasi->foto) }}" alt="Foto" width="120" class="mb-2"><br>
                @endif
                <input type="file" name="foto" accept="image/*" class="form-control">
                <small class="form-text text-muted">Kosongkan jika tidak ingin mengganti foto.</small>
            </div>

            <div class="form-group mb-3">
                <label>Status</label>
                <select name="status" class="form-control">
                    <option value="" {{ is_null($reservasi->status) ? 'selected' : '' }}>-- Pilih Status --</option>
                    <option value="1" {{ $reservasi->status === 1 ? 'selected' : '' }}>Aktif</option>
                    <option value="0" {{ $reservasi->status === 0 ? 'selected' : '' }}>Tidak Aktif</option>
                </select>
            </div> --}}

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('reservasi.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection

