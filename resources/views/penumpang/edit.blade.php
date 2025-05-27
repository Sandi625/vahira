@extends('layout.master')

@section('content')
    <div class="container mt-3">
        <h2>Edit Penumpang</h2>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('penumpang.update', $penumpang->id_pelanggan) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group mb-3">
                <label>Reservasi</label>
                <select name="id_reservasi" class="form-control" required>
            <option value="">Pilih Reservasi</option>
            @foreach($reservasis as $reservasi)
                <option value="{{ $reservasi->id_reservasi }}"
                        {{ $penumpang->id_reservasi == $reservasi->id_reservasi ? 'selected' : '' }}>
                    {{ $reservasi->customer->nama_customer ?? '-' }} - {{ $reservasi->tujuan }}
                </option>
            @endforeach
        </select>
            </div>
            <div class="form-group mb-3">
                <label>Nama</label>
                <input type="text" name="nama" class="form-control" value="{{ $penumpang->nama }}" required>
            </div>
            <div class="form-group mb-3">
                <label>Alamat</label>
                <textarea name="alamat" class="form-control" required>{{ $penumpang->alamat }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('penumpang.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection
