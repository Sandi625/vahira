@extends('layout.app')

@section('content')
    <div class="container mt-3">
        <h2>Tambah Reservasi</h2>

        <form action="{{ route('reservasi.pelanggan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- User --}}
            <input type="hidden" name="id_user" value="{{ Auth::id() }}">


            {{-- Nama Pelanggan --}}
            <div class="mb-3">
                <label for="nama_pelanggan" class="form-label">Nama Pelanggan</label>
                <input type="text" name="nama_pelanggan"
                    class="form-control @error('nama_pelanggan') is-invalid @enderror"
                    value="{{ old('nama_pelanggan', $user->name ?? '') }}" readonly>
                @error('nama_pelanggan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>


            {{-- Nomor HP (Pelanggan Utama) --}}
            <div class="mb-3">
                <label for="no_hp" class="form-label">Nomor HP</label>
                <input type="text" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror"
                    value="{{ old('no_hp', $user->no_hp ?? '') }}" readonly>
                @error('no_hp')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Alamat Pelanggan --}}
{{-- Alamat --}}
<div class="mb-3">
    <label for="alamat" class="form-label">Alamat</label>
    <input type="text" name="alamat"
        class="form-control @error('alamat') is-invalid @enderror"
        value="{{ old('alamat', $user->alamat ?? '') }}">
    @error('alamat')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>




            {{-- Paket Wisata (Wajib) --}}
            <div class="mb-3">
                <label for="id_paket" class="form-label">Paket Wisata <span class="text-danger">*</span></label>
                <select name="id_paket" id="id_paket" class="form-control @error('id_paket') is-invalid @enderror"
                    required>
                    <option value="">-- Pilih Paket Wisata --</option>
                    @foreach ($pakets as $paket)
                        <option value="{{ $paket->id }}" {{ old('id_paket') == $paket->id ? 'selected' : '' }}>
                            {{ $paket->nama_paket }} - Kuota: {{ $paket->kuota }} -
                            Rp{{ number_format($paket->harga, 0, ',', '.') }}
                        </option>
                    @endforeach
                </select>
                @error('id_paket')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>





            {{-- Tanggal Pesan --}}
            <div class="mb-3">
                <label for="tanggal_pesan" class="form-label">Tanggal Pesan</label>
                <input type="date" name="tanggal_pesan" class="form-control @error('tanggal_pesan') is-invalid @enderror"
                    value="{{ old('tanggal_pesan', date('Y-m-d')) }}" readonly>
                @error('tanggal_pesan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>



            {{-- Tanggal Berangkat --}}
            <div class="mb-3">
                <label for="tanggal_berangkat" class="form-label">Tanggal Berangkat <span
                        class="text-danger">*</span></label>
                <input type="date" name="tanggal_berangkat"
                    class="form-control @error('tanggal_berangkat') is-invalid @enderror"
                    value="{{ old('tanggal_berangkat') }}" min="{{ date('Y-m-d') }}">
                @error('tanggal_berangkat')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>




            <div class="mb-3">
                <label class="form-label">Peran</label><br>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="peran" id="peran1" value="PEMESAN_SAJA"
                        {{ old('peran') == 'PEMESAN_SAJA' ? 'checked' : '' }} checked>
                    <label class="form-check-label" for="peran1">Pemesan Saja</label>
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="peran" id="peran2"
                        value="PEMESAN_DAN_PENUMPANG" {{ old('peran') == 'PEMESAN_DAN_PENUMPANG' ? 'checked' : '' }}>
                    <label class="form-check-label" for="peran2">Pemesan & Penumpang</label>
                </div>
            </div>



            <!-- Tombol Tambah Customer -->
            <button type="button" class="btn btn-success mb-3" id="add-detail-btn">+ Tambah Penumpang </button>

            <!-- Wrapper Detail Reservasi (disembunyikan dulu sampai tombol diklik) -->
            <div id="detail-wrapper" style="display: none;">
                <h5>Detail Reservasi</h5>
                <div id="detail-container"></div>
            </div>



            {{-- Tombol Tambah --}}
            <!-- Tombol Tambah Customer -->
            {{-- <button type="button" class="btn btn-success mb-3" id="add-detail-btn">+ Tambah Customer</button> --}}
            <!-- Wrapper Detail Reservasi (disembunyikan dulu) -->
            <div id="detail-wrapper" style="display: none;">
                <h5>Detail Reservasi</h5>
                <div id="detail-container"></div>
            </div>

            {{-- Tombol Submit --}}
            <button type="submit" class="btn btn-success">Simpan Reservasi</button>
            <a href="{{ route('dashboardpelanggan') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let detailIndex = 0;
            const wrapper = document.getElementById('detail-wrapper');
            const container = document.getElementById('detail-container');
            const addBtn = document.getElementById('add-detail-btn');

            function isPemesanDanPenumpang() {
                return document.getElementById('peran2').checked;
            }

            function getNamaPelanggan() {
                return document.querySelector('input[name="nama_pelanggan"]')?.value || '';
            }

            function getNoHp() {
                return document.querySelector('input[name="no_hp"]')?.value || '';
            }

            function createDetailItem(withCustomer = false) {
                const isFirst = detailIndex === 0;
                const namaPelanggan = (withCustomer && isFirst) ? getNamaPelanggan() : '';
                const noHp = (withCustomer && isFirst) ? getNoHp() : '';

                let html = `
    <div class="detail-item border rounded p-3 mb-3">
        <button type="button" class="btn btn-danger btn-sm float-end remove-detail">Hapus</button>

        <div class="mb-3 mt-4">
            <label class="form-label">Nama Customer <span class="text-danger">*</span></label>
            <input type="text" name="detail[${detailIndex}][nama_customer]" class="form-control customer-nama" value="${namaPelanggan}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Nomor HP <span class="text-danger">*</span></label>
            <input type="text" name="detail[${detailIndex}][no_hp]" class="form-control customer-hp" value="${noHp}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Alamat Penjemputan <span class="text-danger">*</span></label>
            <input type="text" name="detail[${detailIndex}][alamat_penjemputan]" class="form-control" required>
        </div>
    </div>
`;



                container.insertAdjacentHTML('beforeend', html);
                detailIndex++;
            }

            addBtn.addEventListener('click', function() {
                wrapper.style.display = 'block';
                createDetailItem(isPemesanDanPenumpang());
            });

            container.addEventListener('click', function(e) {
                if (e.target.classList.contains('remove-detail')) {
                    e.target.closest('.detail-item').remove();
                    detailIndex--;

                    if (container.querySelectorAll('.detail-item').length === 0) {
                        wrapper.style.display = 'none';
                        detailIndex = 0;
                    }
                }
            });

            // Perubahan peran
            document.querySelectorAll('input[name="peran"]').forEach(function(radio) {
                radio.addEventListener('change', function() {
                    const isPemesanDanPenumpangChecked = this.value === 'PEMESAN_DAN_PENUMPANG';

                    if (isPemesanDanPenumpangChecked) {
                        // Jika belum ada detail, buat satu detail otomatis
                        if (container.querySelectorAll('.detail-item').length === 0) {
                            wrapper.style.display = 'block';
                            createDetailItem(true);
                        }
                    } else {
                        // Jika pilih Pemesan Saja, hapus semua detail dan sembunyikan wrapper
                        container.innerHTML = '';
                        wrapper.style.display = 'none';
                        detailIndex = 0;
                    }
                });
            });


            // Inisialisasi
            @if (old('peran') === 'PEMESAN_DAN_PENUMPANG')
                wrapper.style.display = 'block';
                createDetailItem(true);
            @endif
        });
    </script>

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: '{{ session('error') }}',
                confirmButtonColor: '#d33',
                confirmButtonText: 'Coba Lagi'
            });
        </script>
    @endif

    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Validasi Gagal!',
                html: `{!! implode('<br>', $errors->all()) !!}`,
                confirmButtonColor: '#d33',
                confirmButtonText: 'Perbaiki'
            });
        </script>
    @endif








    <!-- WhatsApp Floating Button -->
    <a href="https://wa.me/6281330920809?text=Halo%20admin%2C%20saya%20ingin%20memesan%20kursi." class="wa-float"
        target="_blank">
        <img src="https://img.icons8.com/color/48/000000/whatsapp--v1.png" alt="WhatsApp">
    </a>

    <style>
        .wa-float {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 999;
            background-color: #25D366;
            padding: 10px;
            border-radius: 50%;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.3);
        }

        .wa-float img {
            width: 40px;
            height: 40px;
        }
    </style>
@endsection
