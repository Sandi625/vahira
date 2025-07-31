<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StatusPembayaranUser extends Controller
{
public function index()
{
    $user = Auth::user();

    // Ambil semua reservasi user beserta relasi bukti transfer dan cash
    $reservasis = Reservasi::with(['buktiTf', 'buktiCash'])
        ->where('id_user', $user->id)
        ->get();

    return view('pelanggan.status_pembayaran', compact('reservasis'));
}



}

