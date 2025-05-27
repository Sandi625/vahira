@extends('layout.master')

@section('content')
<div class="container mt-4">
    <h2>Daftar Pesanan</h2>

    <div class="table-responsive mt-3">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nama Paket</th>
                    <th>Nama Pemesan</th>
                    <th>Tanggal Reservasi</th>
                    <th>No HP</th>
                    <th>Bukti Pembayaran</th>
                    <th>Waktu Dibuat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pesanans as $index => $pesanan)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $pesanan->paket->nama_paket ?? '-' }}</td>
                        <td>{{ $pesanan->nama }}</td>
                        <td>{{ \Carbon\Carbon::parse($pesanan->tanggal_reservasi)->format('d-m-Y') }}</td>
                        <td>{{ $pesanan->no_hp ?? '-' }}</td>
                        <td>
                            @if ($pesanan->foto)
                                <a href="{{ asset($pesanan->foto) }}" target="_blank">Lihat Foto</a>
                            @else
                                Tidak ada
                            @endif
                        </td>
                        <td>{{ $pesanan->created_at->format('d-m-Y H:i') }}</td>
                        <td>
                            <form action="{{ route('pesanan.destroy', $pesanan->id) }}" method="POST" class="d-inline delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger btn-sm btn-delete">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">Belum ada data pesanan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('.btn-delete');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function (e) {
                const form = this.closest('form');

                Swal.fire({
                    title: 'Yakin ingin menghapus?',
                    text: "Data pesanan akan dihapus secara permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>
@endsection

