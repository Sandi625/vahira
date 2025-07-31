@extends('layout.app')

@section('title', 'Daftar Pembayaran Tunai')

@section('content')
<div class="container py-4">
    <h3>Daftar Pembayaran Tunai (Cash)</h3>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($data->isEmpty())
        <p>Tidak ada data pembayaran.</p>
    @else
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama User</th> {{-- ✅ Tambahan --}}
                        <th>Total Bayar</th>
                        <th>Metode</th>
                        <th>Waktu Dibuat</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->user->name ?? '-' }}</td> {{-- ✅ Tampilkan nama user --}}
                            <td>Rp {{ number_format($item->total_bayar, 0, ',', '.') }}</td>
                            <td>{{ ucfirst($item->metode_pembayaran) }}</td>
                            <td>{{ $item->created_at->format('d-m-Y H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <a href="{{ route('user.cash.index') }}" class="btn btn-primary mt-3">Tambah Pembayaran Baru</a>
</div>
@endsection
