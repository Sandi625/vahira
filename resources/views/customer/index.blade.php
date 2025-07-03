@extends('layout.master')

@section('content')
    <div class="container mt-3">
        <h2>Data Customer</h2>
        <a href="{{ route('customer.create') }}" class="btn btn-primary mb-3">Tambah Customer</a>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th> {{-- Ganti dari ID --}}
                    <th>Nama Customer</th>
                    <th>Email Customer</th>
                    <th>Admin</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($customers as $customer)
                    <tr>
                        <td>{{ $loop->iteration }}</td> {{-- Nomor urut --}}
                        <td>{{ $customer->nama_customer }}</td>
                        <td>{{ $customer->email_customer }}</td>
                        <td>{{ $customer->admin->nama_admin ?? '-' }}</td>
                        <td>
                            <a href="{{ route('customer.edit', $customer->id_customer) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('customer.destroy', $customer->id_customer) }}" method="POST" style="display:inline;">
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
