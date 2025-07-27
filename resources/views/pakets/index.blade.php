@extends('layout.master')

@section('content')
<div class="container">
    <h2>Daftar Paket Wisata</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('pakets.create') }}" class="btn btn-primary mb-3">Tambah Paket</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Paket</th>
                <th>Deskripsi</th>
                <th>Harga</th>
                <th>Kuota</th>
                <th>Foto</th>
                <th>Status</th> {{-- ✅ Menampilkan status enum --}}
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pakets as $index => $paket)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $paket->nama_paket }}</td>
                    <td>{{ $paket->deskripsi }}</td>
                    <td>Rp{{ number_format($paket->harga, 0, ',', '.') }}</td>
                    <td>{{ $paket->kuota }}</td>
                    <td>
                        @if ($paket->foto)
                            <img src="{{ asset($paket->foto) }}" alt="Foto Paket" width="80">
                        @else
                            <span class="text-muted">Tidak ada foto</span>
                        @endif
                    </td>
                    <td>{{ $paket->status_label }}</td> {{-- ✅ Gunakan accessor --}}
                    <td>
                        <a href="{{ route('pakets.edit', $paket->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('pakets.destroy', $paket->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">Belum ada paket wisata.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
