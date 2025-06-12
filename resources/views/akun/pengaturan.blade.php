@extends('layout.master')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Profil Saya</h4>
                </div>
                <div class="card-body p-4">
                    <table class="table table-bordered table-hover fs-4 mb-0">
                        <tbody>
                            <tr>
                                <th style="width: 180px; vertical-align: middle;">Nama</th>
                                <td class="align-middle">{{ $user->name }}</td>
                            </tr>
                            <tr>
                                <th style="vertical-align: middle;">Email</th>
                                <td class="align-middle">{{ $user->email }}</td>
                            </tr>
                            <tr>
                                <th style="vertical-align: middle;">Role</th>
                                <td class="align-middle">{{ ucfirst($user->role->value) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer text-end">
                    <a href="{{ route('akunadmin.edit') }}" class="btn btn-sm btn-primary">Edit Akun</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
