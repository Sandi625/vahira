<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use App\Models\Reservasi;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PelangganController extends Controller
{
    // Menampilkan semua pembayaran
public function index()
{
    // Ambil semua paket beserta relasi reservasi dan customer dari reservasi
    $pakets = Paket::all();

    // Kirim data ke view
    return view('pelanggan.index', compact('pakets'));
}





    // Form tambah pembayaran
    public function create()
    {

    }

    // Proses simpan pembayaran baru
    public function store(Request $request)
    {
        $request->validate([
            'id_reservasi' => 'required|exists:reservasi,id_reservasi',
            'jumlah_pembayaran' => 'required|numeric|min:1',
            'metode_pembayaran' => 'required|string|max:100',
            'tanggal_pembayaran' => 'required|date',
            'status_pembayaran' => 'nullable|in:DITERIMA,TIDAK DITERIMA',
        ]);

        Pembayaran::create([
            'id_reservasi' => $request->id_reservasi,
            'jumlah_pembayaran' => $request->jumlah_pembayaran,
            'metode_pembayaran' => $request->metode_pembayaran,
            'tanggal_pembayaran' => $request->tanggal_pembayaran,
            'status_pembayaran' => $request->status_pembayaran ?? null,
        ]);

        return redirect()->route('pelanggan.index')->with('success', 'Pembayaran berhasil ditambahkan.');
    }

    // Form edit pembayaran
    public function edit($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $reservasis = Reservasi::with('customer')->get();
        return view('pelanggan.edit', compact('pembayaran', 'reservasis'));
    }

    // Proses update pembayaran
    public function update(Request $request, $id)
    {
        $pembayaran = Pembayaran::findOrFail($id);

        $request->validate([
            'id_reservasi' => 'required|exists:reservasi,id_reservasi',
            'jumlah_pembayaran' => 'required|numeric|min:1',
            'metode_pembayaran' => 'required|string|max:100',
            'tanggal_pembayaran' => 'required|date',
            'status_pembayaran' => 'nullable|in:DITERIMA,TIDAK DITERIMA',
        ]);

        $pembayaran->update([
            'id_reservasi' => $request->id_reservasi,
            'jumlah_pembayaran' => $request->jumlah_pembayaran,
            'metode_pembayaran' => $request->metode_pembayaran,
            'tanggal_pembayaran' => $request->tanggal_pembayaran,
            'status_pembayaran' => $request->status_pembayaran ?? null,
        ]);

        return redirect()->route('pelanggan.index')->with('success', 'Pembayaran berhasil diperbarui.');
    }

    // Hapus pembayaran
    public function destroy($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->delete();

        return redirect()->route('pelanggan.index')->with('success', 'Pembayaran berhasil dihapus.');
    }
}
