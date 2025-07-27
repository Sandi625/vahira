@extends('layout.app')

@section('title', 'Daftar Bank')

@section('content')
    <div class="container py-4">
        <h3 class="mb-4">Daftar Bank Tujuan Transfer</h3>

        @if($banks->isEmpty())
            <p>Tidak ada data bank.</p>
        @else
            <div class="row">
                @foreach ($banks as $bank)
                    <div class="col-md-4 mb-3">
                        <div class="card h-100">
                            @if($bank->logo_bank)
                                <img src="{{ asset($bank->logo_bank) }}" class="card-img-top" style="max-height: 150px; object-fit: contain;" alt="Logo {{ $bank->nama_bank }}">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $bank->nama_bank }}</h5>
                                <p class="card-text">No. Rekening: <strong>{{ $bank->nomor_rekening }}</strong></p>
                                <p class="card-text">Atas Nama: {{ $bank->nama_pemilik }}</p>

                                {{-- Tombol Upload Bukti Transfer --}}
                                <a href="{{ route('bukti_tf.create', ['bank_id' => $bank->id]) }}" class="btn btn-sm btn-primary mt-2">
                                    Upload Bukti Transfer
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
