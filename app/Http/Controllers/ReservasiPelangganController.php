<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;
use Illuminate\Http\Request;
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
        return view('pelanggan.reservasi.create');
    }

    // Simpan reservasi baru untuk pelanggan yang login
public function store(Request $request)
{
    $validatedData = $request->validate([
        'nama_customer' => 'required|string|max:255',
        'no_hp' => 'required|string|max:20',
        'tujuan' => 'nullable|string|max:255',
        'tanggal_reservasi' => 'required|date',
        'bukti_pembayaran' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
    ]);

    // Tambahkan id_user dari user yang sedang login
    $validatedData['id_user'] = Auth::id();

    if ($request->hasFile('bukti_pembayaran')) {
        $file = $request->file('bukti_pembayaran');
        $path = $file->store('bukti_pembayaran', 'public');
        $validatedData['bukti_pembayaran'] = $path;
    }

    Reservasi::create($validatedData);

    return redirect()->route('reservasi.pelanggan.create')->with('success', 'Reservasi berhasil dikirim.');
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
            'tujuan' => 'nullable|string|max:255',
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
