@extends('layout.master')

@section('content')
<div class="container mt-3">
    <h2>Edit Admin</h2>

    <form action="{{ route('admin.update', $admin->id_admin) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama Admin</label>
            <input type="text" name="nama_admin"
                   value="{{ old('nama_admin', $admin->nama_admin) }}"
                   class="form-control" required>
            @error('nama_admin')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email"
                   value="{{ old('email', $admin->email) }}"
                   class="form-control" required>
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Password <small class="text-muted">(Biarkan kosong jika tidak ingin diubah)</small></label>
            <input type="password" name="password" class="form-control">
            @error('password')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button class="btn btn-success">Update</button>
        <a href="{{ route('admin.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
