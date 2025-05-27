@extends('layout.master')

@section('content')
    <div class="container mt-3">
        <h2>Detail Admin</h2>
        <p><strong>ID:</strong> {{ $admin->id_admin }}</p>
        <p><strong>Nama Admin:</strong> {{ $admin->nama_admin }}</p>
        <p><strong>Email:</strong> {{ $admin->email }}</p>

        <a href="{{ route('admin.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
@endsection
