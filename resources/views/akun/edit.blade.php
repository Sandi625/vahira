@extends('layout.master')

@section('content')
<div class="container">
    <h2>Pengaturan Akun</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('akunadmin.update') }}" method="POST">
        @csrf
        @method('PUT') <!-- Tambahkan ini -->

        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}">
            @error('name') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}">
            @error('email') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label>Password Baru (kosongkan jika tidak ingin mengganti)</label>
            <input type="password" name="password" class="form-control">
            @error('password') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label>Konfirmasi Password</label>
            <input type="password" name="password_confirmation" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>
</div>
@endsection

