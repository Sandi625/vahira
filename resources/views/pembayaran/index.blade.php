@extends('layout.master')

@section('content')
    <div class="container mt-3">
        <h2>Data Pembayaran</h2>
        <a href="{{ route('pembayaran.create') }}" class="btn btn-primary mb-3">Tambah Pembayaran</a>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Reservasi</th>
                    <th>Jumlah</th>
                    <th>Metode</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pembayarans as $pembayaran)
                    <tr>
                        <td>{{ $pembayaran->id_pembayaran }}</td>
                        <td>
                            {{ $pembayaran->reservasi->customer->nama_customer ?? '-' }} -
                            {{ $pembayaran->reservasi->tujuan ?? '-' }}
                        </td>
                        <td>{{ number_format($pembayaran->jumlah_pembayaran) }}</td>
                        <td>{{ $pembayaran->metode_pembayaran }}</td>
                        <td>
                            @if ($pembayaran->status_pembayaran == 'DITERIMA')
                                <span class="badge bg-success">DITERIMA</span>
                            @elseif($pembayaran->status_pembayaran == 'TIDAK DITERIMA')
                                <span class="badge bg-danger">TIDAK DITERIMA</span>
                            @else
                                <span class="badge bg-secondary">-</span>
                            @endif
                        </td>

                        <td>{{ $pembayaran->tanggal_pembayaran }}</td>
                        <td>
                            <a href="{{ route('pembayaran.edit', $pembayaran->id_pembayaran) }}"
                                class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('pembayaran.destroy', $pembayaran->id_pembayaran) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Yakin ingin menghapus?')"
                                    class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
