@extends('layout.app')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4">Daftar Paket Wisata</h2>
        <div class="row">
            @foreach ($pakets as $paket)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        @if ($paket->foto)
                            <img src="{{ asset($paket->foto) }}" alt="Foto Paket" class="card-img-top"
                                style="height: 200px; object-fit: cover;">
                        @else
                            <div class="card-img-top d-flex align-items-center justify-content-center bg-light"
                                style="height: 200px;">
                                <span class="text-muted">Tidak ada foto</span>
                            </div>
                        @endif

                        <div class="card-body">
                            <h5 class="card-title">{{ $paket->nama_paket }}</h5>
                            <p class="card-text">{{ Str::limit($paket->deskripsi, 100) }}</p>
                            <p class="card-text"><strong>Harga:</strong> Rp {{ number_format($paket->harga, 0, ',', '.') }}</p>
                        </div>
                        <div class="card-footer bg-transparent border-top-0 text-center">
                            <a href="{{ route('pesanan.create', ['id_paket' => $paket->id]) }}"
                                class="btn btn-primary">Pesan</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

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
