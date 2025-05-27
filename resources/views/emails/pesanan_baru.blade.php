<h2>Pesanan Baru Telah Dibuat</h2>

<p><strong>Nama:</strong> {{ $data['nama'] }}</p>
<p><strong>Paket:</strong> {{ $data['id_paket'] }}</p>
<p><strong>Tanggal Reservasi:</strong> {{ $data['tanggal_reservasi'] }}</p>
<p><strong>Nomor HP:</strong> {{ $data['no_hp'] ?? '-' }}</p>
@if(!empty($data['foto']))
    <p><strong>Bukti Pembayaran:</strong> <a href="{{ asset($data['foto']) }}" target="_blank">Lihat Gambar</a></p>
@endif
