@extends('layout.master')

@section('content')
    <div class="container mt-3">
        <h2>Tambah Customer</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('customer.store') }}" method="POST">
            @csrf
            <div class="form-group mb-3">
                <label>Nama Customer</label>
                <input type="text" name="nama_customer" class="form-control" value="{{ old('nama_customer') }}" required>
            </div>
            <div class="form-group mb-3">
                <label>Email Customer</label>
                <input type="email" name="email_customer" class="form-control" value="{{ old('email_customer') }}" required>
            </div>
            <div class="form-group mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="form-group mb-3">
                <label>Admin</label>
                <select name="id_admin" class="form-control" required>
                    <option value="">-- Pilih Admin --</option>
                    @foreach ($admins as $admin)
                        <option value="{{ $admin->id_admin }}" {{ old('id_admin') == $admin->id_admin ? 'selected' : '' }}>
                            {{ $admin->nama_admin }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('customer.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection
