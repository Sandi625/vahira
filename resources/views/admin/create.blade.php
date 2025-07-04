@extends('layout.master')

@section('content')
<div class="container mt-3">
    <h2>Tambah Admin</h2>

    <form action="{{ route('admin.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Nama Admin</label>
            <input type="text" name="nama_admin" class="form-control" value="{{ old('nama_admin') }}" required>
            @error('nama_admin')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
            @error('password')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button class="btn btn-success">Simpan</button>
        <a href="{{ route('admin.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
