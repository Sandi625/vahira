<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class StatusPembayaranUser extends Controller
{
public function index()
{
    $user = Auth::user();

    $pembayarans = Pembayaran::whereHas('reservasi', function ($query) use ($user) {
        $query->where('id_user', $user->id);
    })->with('reservasi')->get();

    return view('pelanggan.status_pembayaran', compact('pembayarans'));
}

}
