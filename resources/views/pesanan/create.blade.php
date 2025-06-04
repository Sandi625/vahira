@extends('layout.app')

@section('content')
@php
    $selectedPaketId = request()->get('id_paket', old('id_paket'));
    $selectedPaket = $pakets->firstWhere('id', $selectedPaketId);
@endphp

@if ($selectedPaket)
    <div class="container mt-4">
        <div class="card mb-4 shadow-sm">
            <div class="row g-0 align-items-center">
                @if ($selectedPaket->foto)
                    <div class="col-md-4">
                        <img src="{{ asset($selectedPaket->foto) }}"
                             alt="{{ $selectedPaket->nama_paket }}"
                             class="img-fluid rounded-start"
                             style="max-height: 200px; object-fit: cover; width: 100%;">
                    </div>
                @endif
                <div class="{{ $selectedPaket->foto ? 'col-md-8' : 'col-12' }}">
                    <div class="card-body">
                        <h5 class="card-title fw-bold mb-3">{{ $selectedPaket->nama_paket }}</h5>
                        <p class="card-text text-muted" style="max-height: 120px; overflow-y: auto; scroll-behavior: smooth;">
                            {{ $selectedPaket->deskripsi }}
                        </p>
                        <p class="card-text mt-3">
                            <span class="badge bg-success fs-6">
                                Harga: Rp {{ number_format($selectedPaket->harga, 0, ',', '.') }}
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

<div class="container mt-4">
    <h2>Tambah Pesanan Baru</h2>

    <form action="{{ route('pesanan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="id_paket" class="form-label">Pilih Paket</label>
            <select name="id_paket" id="id_paket" class="form-select" required>
                <option value="">-- Pilih Paket --</option>
                @foreach ($pakets as $paket)
                    <option value="{{ $paket->id }}" {{ $selectedPaketId == $paket->id ? 'selected' : '' }}>
                        {{ $paket->nama_paket }} - Rp {{ number_format($paket->harga, 0, ',', '.') }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="nama" class="form-label">Nama Pemesan</label>
            <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama') }}" required>
        </div>

        <div class="mb-3">
            <label for="tanggal_reservasi" class="form-label">Tanggal Reservasi</label>
            <input type="date" name="tanggal_reservasi" id="tanggal_reservasi" class="form-control"
                value="{{ old('tanggal_reservasi') }}" required>
        </div>

        <div class="mb-3">
            <label for="no_hp" class="form-label">Nomor HP (opsional)</label>
            <input type="text" name="no_hp" id="no_hp" class="form-control" value="{{ old('no_hp') }}">
        </div>

        <div class="mb-3">
            <label for="foto" class="form-label">Upload Bukti Pembayaran (opsional)</label>
            <input type="file" name="foto" id="foto" class="form-control" accept="image/*">
        </div>

        <button type="submit" class="btn btn-primary">Simpan Pesanan</button>
        <a href="{{ route('pakets.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection

{{-- SECTION UNTUK SCRIPT DIPISAH --}}
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                confirmButtonText: 'OK'
            });
        @endif
    </script>
@endsection
