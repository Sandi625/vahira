@extends('layout.app')

@section('content')
    <div class="container mt-4">
        <h2>Status Pembayaran Anda</h2>

        @if ($reservasis->isEmpty())
            <div class="alert alert-warning">Tidak ada data reservasi.</div>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pelanggan</th>
                        <th>Jumlah Pembayaran</th>
                        <th>Metode Pembayaran</th>
                        <th>Status</th>
                        <th>Tanggal Pesan</th>
                        <th>Tanggal Berangkat</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reservasis as $index => $reservasi)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $reservasi->nama_pelanggan }}</td>
                            <td>Rp{{ number_format($reservasi->jumlah_pembayaran ?? 0, 0, ',', '.') }}</td>
                            <td>
                                @if ($reservasi->buktiTf)
                                    Transfer
                                @elseif ($reservasi->buktiCash)
                                    Cash
                                @else
                                    Belum memilih
                                @endif
                            </td>



                            <td>
                                @if ($reservasi->status === 'DITERIMA')
                                    <span class="badge bg-success">DITERIMA</span>
                                @elseif ($reservasi->status === 'DITOLAK')
                                    <span class="badge bg-danger">DITOLAK</span>
                                @else
                                    <span class="badge bg-warning text-dark">SEDANG DIPROSES</span>
                                @endif
                            </td>
                            <td>{{ $reservasi->tanggal_pesan->format('d-m-Y') }}</td>
                            <td>{{ $reservasi->tanggal_berangkat->format('d-m-Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        @endif
    </div>
@endsection
