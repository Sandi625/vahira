@extends('layout.master')

@section('title', 'Bukti Transfer User')

@section('content')
<div class="container py-4">
    <h3 class="mb-4">Daftar Bukti Transfer</h3>

    {{-- === Bukti Transfer === --}}
    @if($buktiTransfers->isEmpty())
        <p>Tidak ada bukti transfer.</p>
    @else
        <div class="table-responsive mb-5">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th> {{-- ✅ Tambahan --}}
                <th>Nama User</th>
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
                    <td>{{ $loop->iteration }}</td> {{-- ✅ Nomor urut --}}
                    <td>{{ $bukti->user->name ?? '-' }}</td>
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
                    <td>{{ $bukti->created_at->format('d M Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

    @endif

{{-- === Bukti Cash === --}}
<h3 class="mb-4">Daftar Bukti Pembayaran Tunai (Cash)</h3>

@if($buktiCash->isEmpty())
    <p>Tidak ada bukti cash.</p>
@else
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama User</th> {{-- ✅ Tambahan --}}
                    <th>Total Bayar</th>
                    <th>Metode Pembayaran</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($buktiCash as $cash)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $cash->user->name ?? '-' }}</td> {{-- ✅ Nama User --}}
                        <td>Rp {{ number_format($cash->total_bayar, 0, ',', '.') }}</td>
                        <td>{{ ucfirst($cash->metode_pembayaran) }}</td>
                        <td>{{ $cash->created_at->format('d M Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif

</div>
@endsection
