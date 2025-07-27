@extends('layout.master')

@section('content')
<div class="container">
    <h2>Tambah Paket Wisata</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Terjadi kesalahan!</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pakets.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="nama_paket" class="form-label">Nama Paket</label>
            <input type="text" name="nama_paket" class="form-control" required value="{{ old('nama_paket') }}">
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea name="deskripsi" class="form-control">{{ old('deskripsi') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="number" name="harga" class="form-control" required value="{{ old('harga') }}">
        </div>

        <div class="mb-3">
            <label for="kuota" class="form-label">Kuota Bangku</label>
            <input type="number" name="kuota" class="form-control" min="0" required value="{{ old('kuota') }}">
        </div>

        <div class="mb-3">
            <label for="foto" class="form-label">Foto</label>
            <input type="file" name="foto" class="form-control" accept="image/*">
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status Kuota</label>
            <select name="status" class="form-select">
                <option value="KOUTA_TERSEDIA" {{ old('status') == 'KOUTA_TERSEDIA' ? 'selected' : '' }}>Kuota Tersedia</option>
                <option value="KOUTA_PENUH" {{ old('status') == 'KOUTA_PENUH' ? 'selected' : '' }}>Kuota Penuh</option>
                <option value="BERANGKAT_TANPA_PENUH" {{ old('status') == 'BERANGKAT_TANPA_PENUH' ? 'selected' : '' }}>Berangkat (Tidak Penuh)</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('pakets.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
