<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Paket;
use App\Models\Reservasi;
use Illuminate\Http\Request;
use App\Models\DetailReservasi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class ReservasiPelangganController extends Controller
{
    // Tampilkan reservasi khusus pelanggan yang sedang login
    public function index()
    {
        // Asumsi pelanggan login punya ID yang sama dengan id_customer di tabel reservasi
        $userId = Auth::id(); // misal auth pakai user id sama dengan id_customer

        $reservasis = Reservasi::where('id_customer', $userId)->get();

        return view('pelanggan.reservasi.index', compact('reservasis'));
    }

    // Form tambah reservasi baru
public function create()
{
    $pakets = Paket::where('kuota', '>', 0)->get();
    $user = Auth::user();
    return view('pelanggan.reservasi.create', compact('pakets', 'user'));
}

public function store(Request $request)
{
    try {
        $validatedData = $request->validate([
            'id_paket' => 'required|exists:pakets,id',
            'nama_pelanggan' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'alamat' => 'required|string|max:255', // ⬅️ Tambahkan ini
            'tanggal_pesan' => 'required|date',
            'tanggal_berangkat' => 'required|date|after_or_equal:tanggal_pesan',
            'peran' => 'required|in:PEMESAN_SAJA,PEMESAN_DAN_PENUMPANG',
            'detail' => 'required|array|min:1',
            'detail.*.nama_customer' => 'required|string|max:255',
            'detail.*.no_hp' => 'nullable|string|max:20',
            'detail.*.alamat_penjemputan' => 'nullable|string|max:255',
        ]);

        $validatedData['id_user'] = Auth::id();
        $validDetails = collect($validatedData['detail']);
        $jumlahPenumpang = $validDetails->count();

        $paket = Paket::findOrFail($validatedData['id_paket']);

        if ($paket->kuota < $jumlahPenumpang) {
            return back()->withErrors([
                'kuota' => "Kuota tidak mencukupi untuk $jumlahPenumpang penumpang."
            ])->withInput();
        }

        DB::beginTransaction();

        $reservasi = Reservasi::create([
            'id_user' => $validatedData['id_user'],
            'id_paket' => $validatedData['id_paket'],
            'nama_pelanggan' => $validatedData['nama_pelanggan'],
            'no_hp' => $validatedData['no_hp'],
            'alamat' => $validatedData['alamat'], // ⬅️ Tambahkan ini
            'tanggal_pesan' => $validatedData['tanggal_pesan'],
            'tanggal_berangkat' => $validatedData['tanggal_berangkat'],
            'status' => 'SEDANG DIPROSES',
            'peran' => $validatedData['peran'],
        ]);

        foreach ($validDetails as $item) {
            DetailReservasi::create([
                'id_reservasi' => $reservasi->id_reservasi,
                'nama_customer' => $item['nama_customer'],
                'no_hp' => $item['no_hp'] ?? null,
                'alamat_penjemputan' => $item['alamat_penjemputan'] ?? null,
            ]);
        }

        $totalPembayaran = $paket->harga * $jumlahPenumpang;

        // Simpan total ke session secara persisten
        session()->put('total', $totalPembayaran);

        DB::commit();

        return redirect()->route('reservasi.pelanggan.sukses')
            ->with('success', 'Reservasi berhasil ditambahkan.');

    } catch (\Throwable $e) {
        DB::rollBack();

        Log::error('Gagal menyimpan reservasi: ' . $e->getMessage(), [
            'trace' => $e->getTraceAsString(),
            'request_data' => $request->all()
        ]);

        return back()->with('error', 'Terjadi kesalahan saat menyimpan reservasi. Silakan coba lagi. Pastikan Anda mengisi data penumpang dengan klik tombol tambah penumpang.')->withInput();
    }
}


public function sukses()
{
    $total = session('total');
    return view('pelanggan.reservasi.sukses', compact('total'));
}










    // Form edit reservasi (pastikan hanya bisa edit reservasi milik pelanggan)
    public function edit($id)
    {
        $userId = Auth::id();

        $reservasi = Reservasi::where('id_customer', $userId)->findOrFail($id);

        return view('pelanggan.reservasi.edit', compact('reservasi'));
    }

    // Update reservasi milik pelanggan
    public function update(Request $request, $id)
    {
        $userId = Auth::id();

        $reservasi = Reservasi::where('id_customer', $userId)->findOrFail($id);

        $validatedData = $request->validate([
            // 'tujuan' => 'nullable|string|max:255',
            'no_hp' => 'nullable|string|max:20',
            'tanggal_reservasi' => 'required|date',
        ]);

        $reservasi->update($validatedData);

        return redirect()->route('pelanggan.reservasi.index')->with('success', 'Reservasi berhasil diperbarui.');
    }

    // Hapus reservasi milik pelanggan
    public function destroy($id)
    {
        $userId = Auth::id();

        $reservasi = Reservasi::where('id_customer', $userId)->findOrFail($id);

        $reservasi->delete();

        return redirect()->route('pelanggan.reservasi.index')->with('success', 'Reservasi berhasil dihapus.');
    }
}
