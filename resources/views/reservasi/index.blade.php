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
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Customer</th>
                        <th>Tujuan</th>
                        <th>No HP</th>
                        <th>Tanggal Reservasi</th>
                        {{-- <th>Nama Paket</th>
                        <th>Harga</th>
                        <th>Status</th>
                        <th>Foto</th> --}}
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reservasis as $reservasi)
                        <tr>
                            <td>{{ $reservasi->id_reservasi }}</td>
                            <td>{{ $reservasi->customer->nama_customer ?? '-' }}</td>
                            <td>{{ $reservasi->tujuan ?? '-' }}</td>
                            <td>{{ $reservasi->no_hp ?? '-' }}</td>
                            <td>{{ $reservasi->tanggal_reservasi->format('d-m-Y') }}</td>
                            {{-- <td>{{ $reservasi->nama_paket }}</td>
                            <td>Rp {{ number_format($reservasi->harga, 0, ',', '.') }}</td>
                            <td>
                                @if(is_null($reservasi->status))
                                    <span class="badge bg-secondary">Belum diupdate</span>
                                @elseif($reservasi->status)
                                    <span class="badge bg-success">Aktif</span>
                                @else
                                    <span class="badge bg-danger">Tidak Aktif</span>
                                @endif
                            </td>
                            <td>
                                @if($reservasi->foto)
                                    <img src="{{ asset('uploads/reservasi/' . $reservasi->foto) }}" alt="Foto" width="60" />
                                @else
                                    -
                                @endif
                            </td> --}}
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

            {{-- Jika pakai paginate di controller --}}
            {{-- {{ $reservasis->links() }} --}}
        @endif
    </div>
@endsection

