@extends('layout.master')

@section('content')
<div class="container">
    <h3>Edit Bank</h3>

    <form action="{{ route('banks.update', $bank->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nama_bank" class="form-label">Nama Bank</label>
            <input type="text" class="form-control" name="nama_bank" value="{{ $bank->nama_bank }}" required>
        </div>

        <div class="mb-3">
            <label for="nomor_rekening" class="form-label">Nomor Rekening</label>
            <input type="text" class="form-control" name="nomor_rekening" value="{{ $bank->nomor_rekening }}" required>
        </div>

        <div class="mb-3">
            <label for="nama_pemilik" class="form-label">Nama Pemilik Rekening</label>
            <input type="text" class="form-control" name="nama_pemilik" value="{{ $bank->nama_pemilik }}" required>
        </div>

        <div class="mb-3">
            <label for="logo_bank" class="form-label">Logo Bank (opsional)</label><br>
            @if($bank->logo_bank)
                <img src="{{ asset($bank->logo_bank) }}" width="100" class="mb-2">
            @endif
            <input type="file" class="form-control" name="logo_bank" accept="image/*">
        </div>

        <button type="submit" class="btn btn-primary">Perbarui</button>
        <a href="{{ route('banks.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
