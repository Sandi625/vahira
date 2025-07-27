@extends('layout.master')

@section('content')
<div class="container mt-3">
    <h2>Edit Reservasi</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @php
        $detail = $reservasi->detailReservasi->first();
    @endphp

    <form action="{{ route('reservasi.update', $reservasi->id_reservasi) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
    <label for="id_user">User</label>
    <select name="id_user" class="form-control" required>
        <option value="">-- Pilih User --</option>
        @foreach($users as $user)
            <option value="{{ $user->id }}" {{ old('id_user', $reservasi->id_user) == $user->id ? 'selected' : '' }}>
                {{ $user->name }}
            </option>
        @endforeach
    </select>
</div>

{{-- Pilih Paket Wisata --}}
<div class="form-group mb-3">
    <label for="id_paket">Paket Wisata</label>
    <select name="id_paket" class="form-control" required>
        <option value="">-- Pilih Paket --</option>
        @foreach ($pakets as $paket)
            <option value="{{ $paket->id }}" {{ old('id_paket', $reservasi->id_paket) == $paket->id ? 'selected' : '' }}>
                {{ $paket->nama_paket }} (Sisa: {{ $paket->kuota }} kursi)
            </option>
        @endforeach
    </select>
</div>


     <div class="form-group mb-3">
    <label for="nama_pelanggan">Nama Customer 1</label>
    <input type="text" name="nama_pelanggan" class="form-control"
        value="{{ old('nama_pelanggan', $reservasi->nama_pelanggan) }}" required>
</div>

        {{-- Nomor HP --}}
        <div class="form-group mb-3">
            <label for="no_hp">Nomor HP</label>
            <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp', $reservasi->no_hp) }}" required>
        </div>

        {{-- Alamat --}}
<div class="form-group mb-3">
    <label for="alamat">Alamat</label>
    <input type="text" name="alamat" class="form-control" value="{{ old('alamat', $reservasi->alamat) }}" required>
</div>

        {{-- Jumlah Pembayaran --}}
        <div class="form-group mb-3">
            <label for="jumlah_pembayaran">Jumlah Pembayaran</label>
            <input type="number" name="jumlah_pembayaran" class="form-control" value="{{ old('jumlah_pembayaran', $reservasi->jumlah_pembayaran) }}" required>
        </div>

        {{-- Metode Pembayaran --}}
        <div class="form-group mb-3">
            <label for="metode_pembayaran">Metode Pembayaran</label>
            <select name="metode_pembayaran" class="form-control" required>
                <option value="">-- Pilih Metode --</option>
                <option value="CASH" {{ old('metode_pembayaran', $reservasi->metode_pembayaran) == 'CASH' ? 'selected' : '' }}>CASH</option>
                <option value="TRANSFER" {{ old('metode_pembayaran', $reservasi->metode_pembayaran) == 'TRANSFER' ? 'selected' : '' }}>TRANSFER</option>
            </select>
        </div>

        {{-- Tanggal Pesan --}}
        <div class="form-group mb-3">
            <label for="tanggal_pesan">Tanggal Pesan</label>
            <input type="date" name="tanggal_pesan" class="form-control"
                value="{{ old('tanggal_pesan', \Carbon\Carbon::parse($reservasi->tanggal_pesan)->format('Y-m-d')) }}" required>
        </div>

        {{-- Tanggal Berangkat --}}
        <div class="form-group mb-3">
            <label for="tanggal_berangkat">Tanggal Berangkat</label>
            <input type="date" name="tanggal_berangkat" class="form-control"
                min="{{ now()->format('Y-m-d') }}"
                value="{{ old('tanggal_berangkat', \Carbon\Carbon::parse($reservasi->tanggal_berangkat)->format('Y-m-d')) }}" required>
        </div>

        {{-- Bukti Pembayaran --}}
        <div class="form-group mb-3">
            <label for="bukti_pembayaran">Bukti Pembayaran (opsional)</label><br>
            @if($reservasi->bukti_pembayaran)
                <a href="{{ asset('storage/' . $reservasi->bukti_pembayaran) }}" target="_blank">Lihat file saat ini</a><br><br>
            @endif
            <input type="file" name="bukti_pembayaran" class="form-control">
        </div>

        <hr>
        <h5>Detail Reservasi</h5>

    @foreach($reservasi->detailReservasi as $index => $detail)
    <div class="border rounded p-3 mb-3">
        {{-- Nama Customer --}}
       <div class="form-group mb-2">
        <label for="detail[{{ $index }}][nama_customer]">Nama Customer {{ $index + 2 }}</label>
        <input type="text" name="detail[{{ $index }}][nama_customer]" class="form-control"
            value="{{ old("detail.$index.nama_customer", $detail->nama_customer) }}" required>
    </div>

        {{-- Tujuan --}}
        <div class="form-group mb-2">
            <label for="detail[{{ $index }}][tujuan]">Tujuan</label>
            <input type="text" name="detail[{{ $index }}][tujuan]" class="form-control"
                value="{{ old("detail.$index.tujuan", $detail->tujuan) }}">
        </div>

        {{-- No HP --}}
        <div class="form-group mb-2">
            <label for="detail[{{ $index }}][no_hp]">No HP</label>
            <input type="text" name="detail[{{ $index }}][no_hp]" class="form-control"
                value="{{ old("detail.$index.no_hp", $detail->no_hp) }}">
        </div>

        {{-- Alamat Penjemputan --}}
        <div class="form-group mb-2">
            <label for="detail[{{ $index }}][alamat_penjemputan]">Alamat Penjemputan</label>
            <input type="text" name="detail[{{ $index }}][alamat_penjemputan]" class="form-control"
                value="{{ old("detail.$index.alamat_penjemputan", $detail->alamat_penjemputan) }}">
        </div>

        {{-- Hidden ID detail (jika perlu untuk update) --}}
        <input type="hidden" name="detail[{{ $index }}][id]" value="{{ $detail->id }}">
    </div>
@endforeach
        {{-- Status --}}
{{-- Status (Opsional) --}}
<div class="form-group mb-3">
    <label for="status">Status</label>
    <select name="status" class="form-control">
        <option value="">-- Pilih Status --</option>
        <option value="SEDANG DIPROSES" {{ old('status', $reservasi->status) == 'SEDANG DIPROSES' ? 'selected' : '' }}>SEDANG DIPROSES</option>
        <option value="DITERIMA" {{ old('status', $reservasi->status) == 'DITERIMA' ? 'selected' : '' }}>DITERIMA</option>
        <option value="DITOLAK" {{ old('status', $reservasi->status) == 'DITOLAK' ? 'selected' : '' }}>DITOLAK</option>
    </select>
</div>



        {{-- Tombol --}}
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('reservasi.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
