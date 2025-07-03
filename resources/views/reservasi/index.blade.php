@extends('layout.master')

@section('content')
<div class="container mt-3">
    <h2>Data Reservasi</h2>
    <a href="{{ route('reservasi.create') }}" class="btn btn-primary mb-3">Tambah Reservasi</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($reservasis->isEmpty())
        <div class="alert alert-info">Data reservasi kosong.</div>
    @else
        <div class="table-responsive">
         <table class="table table-bordered table-striped">
<thead class="table-dark">
    <tr>
        <th>No</th> {{-- Ganti dari ID ke No --}}
        <th>Customer</th> {{-- dari relasi customer --}}
        <th>Customer dari Pelanggan</th> {{-- dari relasi pelanggan --}}
        <th>Tujuan</th>
        <th>No HP</th>
        <th>Tanggal Reservasi</th>
        <th>Bukti Pembayaran</th>
        <th>Aksi</th>
    </tr>
</thead>
<tbody>
    @foreach($reservasis as $reservasi)
        <tr>
            <td>{{ $loop->iteration }}</td> {{-- Nomor urut --}}
            <td>{{ $reservasi->customer->nama_customer ?? '-' }}</td>
            <td>{{ $reservasi->nama_customer ?? '-' }}</td>
            <td>{{ $reservasi->tujuan ?? '-' }}</td>
            <td>{{ $reservasi->no_hp ?? '-' }}</td>
            <td>{{ $reservasi->tanggal_reservasi->format('d-m-Y') }}</td>
            <td>
                @if($reservasi->bukti_pembayaran)
                    @php
                        $ext = pathinfo($reservasi->bukti_pembayaran, PATHINFO_EXTENSION);
                    @endphp
                    @if(in_array(strtolower($ext), ['jpg','jpeg','png','gif']))
                        <a href="{{ asset('storage/' . $reservasi->bukti_pembayaran) }}" target="_blank">
                            <img src="{{ asset('storage/' . $reservasi->bukti_pembayaran) }}" alt="Bukti" width="60">
                        </a>
                    @else
                        <a href="{{ asset('storage/' . $reservasi->bukti_pembayaran) }}" target="_blank">Lihat File</a>
                    @endif
                @else
                    <span class="text-muted">–</span>
                @endif
            </td>
            <td>
                <a href="{{ route('reservasi.edit', $reservasi->id_reservasi) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('reservasi.destroy', $reservasi->id_reservasi) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('Yakin ingin menghapus?')" class="btn btn-sm btn-danger">Hapus</button>
                </form>
            </td>
        </tr>
    @endforeach
</tbody>


</table>

        </div>
        {{-- {{ $reservasis->links() }} --}}
    @endif
</div>
@endsection

