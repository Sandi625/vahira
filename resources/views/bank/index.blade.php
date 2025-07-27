@extends('layout.master')

@section('content')
<div class="container">
    <h3>Daftar Bank</h3>
    <a href="{{ route('banks.create') }}" class="btn btn-primary mb-3">Tambah Bank</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Logo</th>
                <th>Nama Bank</th>
                <th>No. Rekening</th>
                <th>Nama Pemilik</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($banks as $bank)
                <tr>
                    <td>
                        @if($bank->logo_bank)
                            <img src="{{ asset($bank->logo_bank) }}" alt="Logo" width="80">
                        @else
                            Tidak Ada
                        @endif
                    </td>
                    <td>{{ $bank->nama_bank }}</td>
                    <td>{{ $bank->nomor_rekening }}</td>
                    <td>{{ $bank->nama_pemilik }}</td>
                    <td>
                        <a href="{{ route('banks.edit', $bank->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('banks.destroy', $bank->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Yakin ingin hapus bank ini?')" class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
