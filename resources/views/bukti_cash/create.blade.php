@extends('layout.app')

@section('title', 'Pembayaran Tunai')

@section('content')
<div class="container py-4">
    <h3>Pembayaran Tunai (Cash)</h3>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('user.cash.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="total_bayar" class="form-label">Total Bayar (Rp)</label>
            <input
                type="text"
                name="total_bayar"
                id="total_bayar"
                class="form-control @error('total_bayar') is-invalid @enderror"
                required
                placeholder="Contoh: Rp 100.000"
                value="{{ old('total_bayar') }}"
                oninput="formatRupiah(this)"
                autocomplete="off"
            >
            @error('total_bayar')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Simpan Pembayaran</button>
        <a href="{{ url('/reservasi/sukses') }}" class="btn btn-secondary">Kembali0</a>
    </form>
</div>
@endsection

@push('scripts')
<script>
    function formatRupiahText(angka) {
        let split = angka.split(',');
        let sisa = split[0].length % 3;
        let rupiah = split[0].substring(0, sisa);
        let ribuan = split[0].substring(sisa).match(/\d{3}/gi);

        if (ribuan) {
            let separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
        return rupiah ? 'Rp ' + rupiah : '';
    }

    function formatRupiah(input) {
        let angka = input.value.replace(/[^,\d]/g, '');
        input.value = formatRupiahText(angka);
    }

    // Format angka saat halaman pertama kali dimuat (jika ada nilai dari old())
    window.addEventListener('DOMContentLoaded', function () {
        const input = document.getElementById('total_bayar');
        if (input.value && !input.value.startsWith('Rp')) {
            let rawValue = input.value.replace(/[^,\d]/g, '');
            input.value = formatRupiahText(rawValue);
        }
    });

    // Bersihkan nilai sebelum dikirim ke server (hanya angka)
    document.querySelector('form').addEventListener('submit', function () {
        const input = document.getElementById('total_bayar');
        input.value = input.value.replace(/[^0-9]/g, '');
    });
</script>
@endpush
