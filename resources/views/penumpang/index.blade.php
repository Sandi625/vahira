@extends('layout.master')

@section('content')
    <div class="container mt-3">
        <h2>Data Penumpang</h2>
        <a href="{{ route('penumpang.create') }}" class="btn btn-primary mb-3">Tambah Penumpang</a>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th> {{-- Ganti dari ID --}}
                    <th>Reservasi</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($penumpangs as $penumpang)
                    <tr>
                        <td>{{ $loop->iteration }}</td> {{-- Nomor urut --}}
                        <td>
                            {{ $penumpang->reservasi->customer->nama_customer ?? '-' }} -
                            {{ $penumpang->reservasi->tujuan ?? '-' }}
                        </td>
                        <td>{{ $penumpang->nama }}</td>
                        <td>{{ $penumpang->alamat }}</td>
                        <td>
                            <a href="{{ route('penumpang.edit', $penumpang->id_pelanggan) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('penumpang.destroy', $penumpang->id_pelanggan) }}" method="POST" style="display:inline;">
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
@endsection

