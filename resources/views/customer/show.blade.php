@extends('layout.master')

@section('content')
    <h1>Detail Customer</h1>

    <p>Nama: {{ $customer->nama_customer }}</p>
    <p>Email: {{ $customer->email_customer }}</p>
    <p>Admin: {{ $customer->admin->nama_admin ?? '-' }}</p>

    <a href="{{ route('customer.index') }}" class="btn btn-secondary">Kembali</a>
@endsection
