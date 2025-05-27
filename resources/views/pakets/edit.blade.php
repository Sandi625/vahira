@extends('layout.master')

@section('content')
<div class="container">
    <h2>Edit Paket Wisata</h2>

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

    <form action="{{ route('pakets.update', $paket->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nama_paket" class="form-label">Nama Paket</label>
            <input type="text" name="nama_paket" class="form-control" required value="{{ old('nama_paket', $paket->nama_paket) }}">
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea name="deskripsi" class="form-control">{{ old('deskripsi', $paket->deskripsi) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="number" name="harga" class="form-control" required value="{{ old('harga', $paket->harga) }}">
        </div>

       <div class="mb-3">
    <label for="foto" class="form-label">Foto</label>
    <input type="file" name="foto" class="form-control" accept="image/*">
    @if ($paket->foto)
        <div class="mt-2">
            <img src="{{ asset($paket->foto) }}" alt="Foto Paket" width="150">
        </div>
    @endif
</div>


        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" class="form-select">
                <option value="1" {{ $paket->status == 1 ? 'selected' : '' }}>Aktif</option>
                <option value="0" {{ $paket->status == 0 ? 'selected' : '' }}>Tidak Aktif</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('pakets.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
