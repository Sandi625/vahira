@extends('layout.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Profil Saya</h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover fs-5 mb-0">
                        <tbody>
                            <tr>
                                <th style="width: 160px;">Nama</th>
                                <td>{{ $user->name }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ $user->email }}</td>
                            </tr>
                            <tr>
                                <th>Role</th>
                                <td>{{ ucfirst($user->role->value ?? $user->role) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer text-end">
                    <a href="{{ route('akun.edit') }}" class="btn btn-sm btn-primary">Edit Akun</a>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
