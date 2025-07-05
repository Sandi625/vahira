@extends('layout.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Selamat Datang di Dashboard Bintoro Travel</h2>

    <div class="alert alert-info">
        <strong>Bintoro Travel</strong> siap melayani perjalanan Anda dengan nyaman, cepat, dan terpercaya.
        Melalui dashboard ini, Anda dapat melihat informasi reservasi, histori perjalanan, dan data akun Anda.
    </div>

    <div class="row g-4">
        <!-- Layanan Unggulan -->
        <div class="col-md-6 col-lg-4">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center">
                    <i class="fas fa-bus-alt fa-2x text-primary mb-3"></i>
                    <h5 class="card-title">Armada Nyaman</h5>
                    <p class="card-text">Kami menyediakan armada terbaru dan bersih untuk kenyamanan perjalanan Anda.</p>
                </div>
            </div>
        </div>

        <!-- Pemesanan Online -->
        <div class="col-md-6 col-lg-4">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center">
                    <i class="fas fa-laptop fa-2x text-success mb-3"></i>
                    <h5 class="card-title">Pemesanan Online</h5>
                    <p class="card-text">Reservasi tiket kapan saja dan di mana saja hanya dalam beberapa klik.</p>
                </div>
            </div>
        </div>

        <!-- Pelayanan 24 Jam -->
        <div class="col-md-6 col-lg-4">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center">
                    <i class="fas fa-headset fa-2x text-warning mb-3"></i>
                    <h5 class="card-title">Layanan Pelanggan</h5>
                    <p class="card-text">Tim kami siap membantu Anda 24 jam jika ada pertanyaan atau kebutuhan.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Tentang Anda -->
    <div class="mt-5">
        <h4 class="mb-3">Informasi Akun Anda</h4>
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <p><strong>Nama:</strong> {{ Auth::user()->name }}</p>
                <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                <p><strong>Status Member:</strong> Member Aktif</p>
            </div>
        </div>
    </div>

    <!-- Riwayat Pembayaran -->
    <div class="mt-5">
        <h4 class="mb-3">Riwayat Pembayaran Anda</h4>
        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Tujuan</th>
                    <th>Tanggal Berangkat</th>
                    <th>Status Pembayaran</th>
                    <th>Metode</th>
                    <th>Jumlah</th>
                    <th>Tanggal Pembayaran</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pembayarans as $index => $pembayaran)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $pembayaran->reservasi->tujuan ?? '-' }}</td>
                        <td>{{ \Carbon\Carbon::parse($pembayaran->reservasi->tanggal_berangkat)->translatedFormat('d F Y') }}</td>
                        <td>
                            @if ($pembayaran->status_pembayaran == 'DITERIMA')
                                <span class="badge bg-success">Diterima</span>
                            @elseif ($pembayaran->status_pembayaran == 'TIDAK DITERIMA')
                                <span class="badge bg-danger">Tidak Diterima</span>
                            @else
                                <span class="badge bg-secondary">Belum Diproses</span>
                            @endif
                        </td>
                        <td>{{ ucfirst(strtolower($pembayaran->metode_pembayaran)) }}</td>
                        <td>Rp {{ number_format($pembayaran->jumlah_pembayaran, 0, ',', '.') }}</td>
                        <td>{{ \Carbon\Carbon::parse($pembayaran->tanggal_pembayaran)->translatedFormat('d F Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">Belum ada pembayaran.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
