@extends('layout.app')

@section('content')
<div class="container">
    <h4>Upload Bukti Transfer</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('bukti_tf.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="bank_id" class="form-label">Pilih Bank</label>
            <select name="bank_id" id="bank_id" class="form-select" required>
                <option value="">-- Pilih Bank --</option>
                @foreach($banks as $bank)
                    <option value="{{ $bank->id }}">{{ $bank->nama_bank }} - {{ $bank->nomor_rekening }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="nama_pengirim" class="form-label">Nama Pengirim</label>
            <input type="text" name="nama_pengirim" id="nama_pengirim" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="jumlah_transfer" class="form-label">Jumlah Transfer (Rp)</label>
            <input type="number" name="jumlah_transfer" id="jumlah_transfer" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="bukti_transfer" class="form-label">Upload Bukti Transfer</label>
            <input type="file" name="bukti_transfer" id="bukti_transfer" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="catatan" class="form-label">Catatan (Opsional)</label>
            <textarea name="catatan" id="catatan" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Kirim</button>
    </form>
</div>
@endsection
