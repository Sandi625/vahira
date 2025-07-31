<?php

namespace App\Http\Controllers;

use App\Models\BuktiCash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BuktiCashController extends Controller
{
    /**
     * Tampilkan daftar semua pembayaran tunai.
     */
    public function index()
    {
        $data = BuktiCash::with('user')->latest()->get(); // Dengan relasi user
        return view('bukti_cash.index', compact('data'));
    }

    /**
     * Tampilkan form input pembayaran tunai.
     */
    public function create()
    {
        return view('bukti_cash.create');
    }

    /**
     * Simpan data pembayaran tunai ke database.
     */
public function store(Request $request)
{
    // Ambil nilai mentah dari input dan bersihkan Rp, titik, spasi
    $rawTotal = preg_replace('/[^0-9]/', '', $request->input('total_bayar'));

    $request->merge([
        'total_bayar' => (int) $rawTotal
    ]);

    $request->validate([
        'total_bayar' => 'required|numeric|min:10',
    ]);

    // Buat bukti cash
    $buktiCash = BuktiCash::create([
        'user_id' => Auth::id(),
        'total_bayar' => $request->total_bayar,
        'metode_pembayaran' => 'cash',
    ]);

    // Ambil reservasi aktif user yang belum memiliki bukti_cash
    $reservasi = \App\Models\Reservasi::where('id_user', Auth::id())
        ->whereNull('id_bukti_cash')
        ->latest() // ambil reservasi terbaru
        ->first();

    if ($reservasi) {
        $reservasi->id_bukti_cash = $buktiCash->id;
        $reservasi->save();
    }

    return redirect()
        ->route('user.cash.list')
        ->with('success', 'Pembayaran tunai berhasil disimpan.');
}



}
