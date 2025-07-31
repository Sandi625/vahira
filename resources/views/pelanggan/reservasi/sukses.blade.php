@extends('layout.app')

@section('title', 'Reservasi Berhasil')

@section('content')
<div class="container py-4">
    <h3>Reservasi Berhasil!</h3>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(isset($total))
        <p>Total pembayaran Anda: <strong>Rp {{ number_format($total, 0, ',', '.') }}</strong></p>
    @else
        <p>Data total pembayaran tidak tersedia.</p>
    @endif

    <a href="{{ route('user.banks.index') }}" class="btn btn-primary mt-3">Pindah ke Halaman Info Bank atau Transfer</a>
    <a href="{{ route('user.cash.index') }}" class="btn btn-success mt-3 ms-2">Bayar Tunai (Cash)</a>
</div>
@endsection
