@extends('layout.master')

@section('content')
<div class="container mt-4">
    <h2>Detail Reservasi</h2>

    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Informasi Umum</h5> <br>
            {{-- <p><strong>User Input:</strong> {{ $reservasi->user->name }}</p> --}}
            <p><strong>Nama Pelanggan:</strong> {{ $reservasi->nama_pelanggan }}</p>
            <p><strong>Alamat:</strong> {{ $reservasi->alamat ?? '-' }}</p>
            <p><strong>Nama Paket:</strong> {{ $reservasi->paket->nama_paket ?? '-' }}</p>

            {{-- <p><strong>Jumlah Pembayaran:</strong> Rp{{ number_format($reservasi->jumlah_pembayaran, 0, ',', '.') }}</p>
            <p><strong>Metode Pembayaran:</strong> {{ $reservasi->metode_pembayaran }}</p> --}}
            <p><strong>Tanggal Pesan:</strong> {{ $reservasi->tanggal_pesan }}</p>
            <p><strong>Tanggal Berangkat:</strong> {{ $reservasi->tanggal_berangkat }}</p>

            {{-- Status --}}
            <p><strong>Status:</strong>
                @if ($reservasi->status === 'DITERIMA')
                    <span class="badge bg-success">DITERIMA</span>
                @elseif ($reservasi->status === 'DITOLAK')
                    <span class="badge bg-danger">DITOLAK</span>
                @else
                    <span class="badge bg-warning text-dark">SEDANG DIPROSES</span>
                @endif
            </p>

            {{-- Bukti Pembayaran --}}
            {{-- @if ($reservasi->bukti_pembayaran)
                <p><strong>Bukti Pembayaran:</strong></p>
                <a href="{{ asset('storage/' . $reservasi->bukti_pembayaran) }}" target="_blank">
                    <img src="{{ asset('storage/' . $reservasi->bukti_pembayaran) }}" alt="Bukti Pembayaran" class="img-thumbnail" style="max-width: 200px;">
                </a>
            @else
                <p><strong>Bukti Pembayaran:</strong> Tidak tersedia</p>
            @endif --}}
        </div>
    </div>

    <h5>Detail Pelanggan (Customer)</h5>
    @forelse($reservasi->detailReservasi as $detail)
        <div class="card mb-3">
            <div class="card-body">
                <p><strong>Nama Customer:</strong> {{ $detail->nama_customer }}</p>
                {{-- <p><strong>Tujuan:</strong> {{ $detail->tujuan ?? '-' }}</p> --}}
                <p><strong>No HP:</strong> {{ $detail->no_hp ?? '-' }}</p>
                <p><strong>Alamat Penjemputan:</strong> {{ $detail->alamat_penjemputan ?? '-' }}</p>
            </div>
        </div>
    @empty
        <p>Tidak ada data detail pelanggan.</p>
    @endforelse

    {{-- Tombol Konfirmasi --}}
    @if (is_null($reservasi->status) || $reservasi->status == 'SEDANG DIPROSES')
        <div class="mt-3">
            <form action="{{ route('reservasi.konfirmasi', $reservasi->id_reservasi) }}" method="POST" class="d-inline">
                @csrf
                <input type="hidden" name="status" value="DITERIMA">
                <button type="submit" class="btn btn-success">Terima Pesanan</button>
            </form>

            <form action="{{ route('reservasi.konfirmasi', $reservasi->id_reservasi) }}" method="POST" class="d-inline ms-2">
                @csrf
                <input type="hidden" name="status" value="DITOLAK">
                <button type="submit" class="btn btn-danger">Tolak Pesanan</button>
            </form>
        </div>
    @endif

    <a href="{{ route('reservasi.index') }}" class="btn btn-secondary mt-3">Kembali</a>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Sukses!',
            text: '{{ session("success") }}',
            confirmButtonColor: '#28a745'
        });
    @endif

    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: '{{ session("error") }}',
            confirmButtonColor: '#dc3545'
        });
    @endif
</script>
@endsection
