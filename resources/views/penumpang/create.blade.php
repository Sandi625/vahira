@extends('layout.master')

@section('content')
    <div class="container mt-3">
        <h2>Tambah Penumpang</h2>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('penumpang.store') }}" method="POST">
            @csrf

            <div class="form-group mb-3">
                <label>Reservasi (Customer - Tujuan)</label>
                <select name="id_reservasi" class="form-control" required>
                    <option value="">Pilih Reservasi</option>
                    @foreach($reservasis as $reservasi)
                        <option value="{{ $reservasi->id_reservasi }}">
                            {{ $reservasi->customer->nama_customer ?? '-' }} - {{ $reservasi->tujuan }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-3">
                <label>Detail Reservasi (Opsional)</label>
                <select name="id_detail_reservasi" class="form-control">
                    <option value="">Tanpa Detail</option>
                    @foreach($reservasis as $reservasi)
                        @foreach($reservasi->detailReservasi as $detail)
                            <option value="{{ $detail->id }}">
                                {{ $detail->nama_customer }}
                            </option>
                        @endforeach
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('penumpang.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>

    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                });
            });
        </script>
    @endif
@endsection
