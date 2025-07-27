@extends('layout.master')

@section('title', 'Bukti Transfer User')

@section('content')
<div class="container py-4">
    <h3 class="mb-4">Daftar Bukti Transfer</h3>

    @if($buktiTransfers->isEmpty())
        <p>Tidak ada bukti transfer.</p>
    @else
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
    <tr>
        <th>Nama User</th> {{-- Tambahan --}}
        <th>Bank</th>
        <th>Nama Pengirim</th>
        <th>Jumlah Transfer</th>
        <th>Bukti</th>
        <th>Catatan</th>
        <th>Tanggal</th>
    </tr>
</thead>
<tbody>
    @foreach ($buktiTransfers as $bukti)
        <tr>
            <td>{{ $bukti->user->name ?? '-' }}</td> {{-- Tampilkan nama user --}}
            <td>{{ $bukti->bank->nama_bank ?? '-' }}</td>
            <td>{{ $bukti->nama_pengirim }}</td>
            <td>Rp {{ number_format($bukti->jumlah_transfer, 0, ',', '.') }}</td>
            <td>
                @if($bukti->bukti_transfer)
                    <a href="{{ asset($bukti->bukti_transfer) }}" target="_blank">
                        <img src="{{ asset($bukti->bukti_transfer) }}" alt="Bukti" width="80">
                    </a>
                @else
                    Tidak ada
                @endif
            </td>
            <td>{{ $bukti->catatan ?? '-' }}</td>
            <td>{{ $bukti->created_at->format('d M Y H:i') }}</td>
        </tr>
    @endforeach
</tbody>

            </table>
        </div>
    @endif
</div>
@endsection
