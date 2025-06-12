@extends('layout.app') <!-- atau layouts.user jika ada -->

@section('content')
    <div class="container mt-4">
        <h3>Status Pembayaran Anda</h3>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tujuan</th>
                    <th>Jumlah</th>
                    <th>Metode</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pembayarans as $pembayaran)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $pembayaran->reservasi->tujuan ?? '-' }}</td>
                        <td>{{ number_format($pembayaran->jumlah_pembayaran) }}</td>
                        <td>{{ $pembayaran->metode_pembayaran }}</td>
                        <td>
                            @if ($pembayaran->status_pembayaran === 'DITERIMA')
                                <span class="badge bg-success">DITERIMA</span>
                            @elseif ($pembayaran->status_pembayaran === 'TIDAK DITERIMA')
                                <span class="badge bg-danger">TIDAK DITERIMA</span>
                            @else
                                <span class="badge bg-secondary">MENUNGGU</span>
                            @endif
                        </td>
                        <td>{{ $pembayaran->tanggal_pembayaran }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Belum ada pembayaran</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
