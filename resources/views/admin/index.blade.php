@extends('layout.master')

@section('content')
    <div class="container mt-3">
        <h2>Data Admin</h2>
        <a href="{{ route('admin.create') }}" class="btn btn-primary mb-3">Tambah Admin</a>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($admins as $admin)
                    <tr>
                        <td>{{ $admin->id_admin }}</td>
                        <td>{{ $admin->nama_admin }}</td>
                        <td>{{ $admin->email }}</td>
                        <td>
                            <a href="{{ route('admin.edit', $admin->id_admin) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('admin.destroy', $admin->id_admin) }}" method="POST" style="display:inline;">
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
