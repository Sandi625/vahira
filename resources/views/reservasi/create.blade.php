@extends('layout.master')

@section('content')
<div class="container mt-3">
    <h2>Tambah Reservasi</h2>

    <form action="{{ route('reservasi.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- User --}}
        <div class="mb-3">
            <label for="id_user" class="form-label">User Input (Admin)</label>
            <select name="id_user" id="id_user" class="form-select @error('id_user') is-invalid @enderror" required>
                <option value="">-- Pilih User --</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ old('id_user') == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
            @error('id_user')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

         {{-- Pilih Paket --}}
        <div class="mb-3">
            <label for="id_paket" class="form-label">Pilih Paket Wisata</label>
            <select name="id_paket" class="form-select @error('id_paket') is-invalid @enderror" required>
                <option value="">-- Pilih Paket --</option>
                @foreach($pakets as $paket)
                    <option value="{{ $paket->id }}" {{ old('id_paket') == $paket->id ? 'selected' : '' }}>
                        {{ $paket->nama_paket }} (Sisa: {{ $paket->kuota }} kursi)
                    </option>
                @endforeach
            </select>
            @error('id_paket')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Nama Pelanggan --}}
        <div class="mb-3">
            <label for="nama_pelanggan" class="form-label">Nama Pelanggan</label>
            <input type="text" name="nama_pelanggan" class="form-control @error('nama_pelanggan') is-invalid @enderror" value="{{ old('nama_pelanggan') }}">
            @error('nama_pelanggan')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        {{-- Nomor HP (Pelanggan Utama) --}}
<div class="mb-3">
    <label for="no_hp" class="form-label">Nomor HP</label>
    <input type="text" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror" value="{{ old('no_hp') }}">
    @error('no_hp')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

{{-- Alamat Pelanggan --}}
<div class="mb-3">
    <label for="alamat" class="form-label">Alamat</label>
    <input type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror" value="{{ old('alamat') }}">
    @error('alamat')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>



        {{-- Jumlah Pembayaran --}}
        <div class="mb-3">
            <label for="jumlah_pembayaran" class="form-label">Jumlah Pembayaran</label>
            <input type="number" name="jumlah_pembayaran" class="form-control @error('jumlah_pembayaran') is-invalid @enderror" value="{{ old('jumlah_pembayaran') }}">
            @error('jumlah_pembayaran')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Metode Pembayaran --}}
        <div class="mb-3">
            <label for="metode_pembayaran" class="form-label">Metode Pembayaran</label>
            <select name="metode_pembayaran" class="form-select @error('metode_pembayaran') is-invalid @enderror">
                <option value="">-- Pilih Metode --</option>
                <option value="CASH" {{ old('metode_pembayaran') == 'CASH' ? 'selected' : '' }}>CASH</option>
                <option value="TRANSFER" {{ old('metode_pembayaran') == 'TRANSFER' ? 'selected' : '' }}>TRANSFER</option>
            </select>
            @error('metode_pembayaran')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Tanggal Pesan --}}
        <div class="mb-3">
            <label for="tanggal_pesan" class="form-label">Tanggal Pesan</label>
            <input type="date" name="tanggal_pesan" class="form-control @error('tanggal_pesan') is-invalid @enderror" value="{{ old('tanggal_pesan') }}">
            @error('tanggal_pesan')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Tanggal Berangkat --}}
        <div class="mb-3">
            <label for="tanggal_berangkat" class="form-label">Tanggal Berangkat</label>
            <input type="date" name="tanggal_berangkat" class="form-control @error('tanggal_berangkat') is-invalid @enderror" value="{{ old('tanggal_berangkat') }}">
            @error('tanggal_berangkat')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Bukti Pembayaran --}}
        <div class="mb-3">
            <label for="bukti_pembayaran" class="form-label">Bukti Pembayaran (Opsional)</label>
            <input type="file" name="bukti_pembayaran" class="form-control @error('bukti_pembayaran') is-invalid @enderror">
            @error('bukti_pembayaran')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <hr>
     <h5>Detail Reservasi</h5>

<div id="detail-container">
    <div class="detail-item border rounded p-3 mb-3">
        <div class="mb-3">
            <label class="form-label">Nama Customer</label>
            <input type="text" name="detail[0][nama_customer]" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Tujuan</label>
            <input type="text" name="detail[0][tujuan]" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Nomor HP</label>
            <input type="text" name="detail[0][no_hp]" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Alamat Penjemputan</label>
            <input type="text" name="detail[0][alamat_penjemputan]" class="form-control">
        </div>
    </div>
</div>

{{-- Tombol Tambah --}}
<button type="button" class="btn btn-success mb-3" id="add-detail-btn">+ Tambah Customer</button>


        {{-- Tombol Submit --}}
        <button type="submit" class="btn btn-success">Simpan Reservasi</button>
        <a href="{{ route('reservasi.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        let detailIndex = 1;

        document.getElementById('add-detail-btn').addEventListener('click', function () {
            const container = document.getElementById('detail-container');

            const html = `
                <div class="detail-item border rounded p-3 mb-3">
                    <button type="button" class="btn btn-danger btn-sm float-end remove-detail">Hapus</button>

                    <div class="mb-3 mt-4">
                        <label class="form-label">Nama Customer</label>
                        <input type="text" name="detail[${detailIndex}][nama_customer]" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tujuan</label>
                        <input type="text" name="detail[${detailIndex}][tujuan]" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nomor HP</label>
                        <input type="text" name="detail[${detailIndex}][no_hp]" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Alamat Penjemputan</label>
                        <input type="text" name="detail[${detailIndex}][alamat_penjemputan]" class="form-control">
                    </div>
                </div>
            `;

            container.insertAdjacentHTML('beforeend', html);
            detailIndex++;
        });

        document.getElementById('detail-container').addEventListener('click', function (e) {
            if (e.target && e.target.classList.contains('remove-detail')) {
                e.target.closest('.detail-item').remove();
            }
        });
    });
</script>
@endsection



@endsection
