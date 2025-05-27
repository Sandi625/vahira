@extends('layout.master')

@section('content')
    <div class="container mt-3">
        <h2>Edit Admin</h2>

        <form action="{{ route('admin.update', $admin->id_admin) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label>Nama Admin</label>
                <input type="text" name="nama_admin" value="{{ $admin->nama_admin }}" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" value="{{ $admin->email }}" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Password (biarkan kosong jika tidak ingin ubah)</label>
                <input type="password" name="password" class="form-control">
            </div>
            <button class="btn btn-success">Update</button>
            <a href="{{ route('admin.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection
