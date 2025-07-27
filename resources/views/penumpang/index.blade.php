@extends('layout.master')

@section('content')
    <div class="container mt-3">
        <h2>Data Penumpang</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($reservasis->isEmpty())
            <div class="alert alert-info">Data penumpang belum tersedia.</div>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Penumpang</th>
                        <th>Nama Paket</th>
                        <th>Detail Reservasi</th>
                        <th>Data Reservasi (yang mewakili untuk membayar)</th>
                        {{-- <th>Total Pembayaran</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reservasis as $reservasi)
                        @php
                            $jumlahPenumpang = $reservasi->detailReservasi->count();
                            $hargaPaket = $reservasi->paket->harga ?? 0;
                            $totalPembayaran =
                                $jumlahPenumpang > 0
                                    ? $jumlahPenumpang * $hargaPaket
                                    : $reservasi->jumlah_pembayaran ?? $hargaPaket;
                        @endphp

                        @if ($jumlahPenumpang > 0)
                            @foreach ($reservasi->detailReservasi as $detail)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $detail->nama_customer ?? '-' }}</td>
                                    <td>{{ $reservasi->paket->nama_paket ?? '-' }}</td>
                                    <td>
                                        <strong>Nama Penumpang:</strong> {{ $detail->nama_customer ?? '-' }}<br>
                                        <strong>No HP:</strong> {{ $detail->no_hp ?? '-' }}<br>
                                        <strong>Alamat Penjemputan:</strong> {{ $detail->alamat_penjemputan ?? '-' }}
                                    </td>
                                    <td>
                                        <strong>Nama Pelanggan:</strong> {{ $reservasi->nama_pelanggan ?? '-' }}<br>
                                        <strong>Alamat:</strong> {{ $reservasi->alamat ?? '-' }}<br>
                                        <strong>No HP:</strong> {{ $reservasi->no_hp ?? '-' }}<br>
                                        {{-- <strong>Metode Pembayaran:</strong> {{ $reservasi->metode_pembayaran ?? '-' }}<br> --}}
                                        <strong>Tanggal Berangkat:</strong> {{ $reservasi->tanggal_berangkat ?? '-' }}<br>
                                        <strong>Paket:</strong> {{ $reservasi->paket->nama_paket ?? '-' }}<br>
                                        <strong>Harga per Orang:</strong> {{ number_format($hargaPaket, 0, ',', '.') }}
                                    </td>
                                    @if ($loop->first)
                                        <td rowspan="{{ $jumlahPenumpang }}">
                                            <strong>{{ number_format($totalPembayaran, 0, ',', '.') }}</strong>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>-</td>
                                <td>{{ $reservasi->paket->nama_paket ?? '-' }}</td>
                                <td>-</td>
                                <td>
                                    <strong>Nama Pelanggan:</strong> {{ $reservasi->nama_pelanggan ?? '-' }}<br>
                                    <strong>Alamat:</strong> {{ $reservasi->alamat ?? '-' }}<br>
                                    <strong>No HP:</strong> {{ $reservasi->no_hp ?? '-' }}<br>
                                    <strong>Metode Pembayaran:</strong> {{ $reservasi->metode_pembayaran ?? '-' }}<br>
                                    <strong>Tanggal Berangkat:</strong> {{ $reservasi->tanggal_berangkat ?? '-' }}<br>
                                    <strong>Paket:</strong> {{ $reservasi->paket->nama_paket ?? '-' }}<br>
                                    <strong>Harga per Orang:</strong> {{ number_format($hargaPaket, 0, ',', '.') }}
                                </td>
                                <td>
                                    <strong>{{ number_format($totalPembayaran, 0, ',', '.') }}</strong>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>

            <div class="d-flex justify-content-center mt-3">
                {{ $reservasis->links() }}
            </div>
        @endif
    </div>
@endsection
