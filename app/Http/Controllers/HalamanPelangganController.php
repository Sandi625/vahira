<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservation; // Assuming you have a Reservation model

class HalamanPelangganController extends Controller
{
    public function index()
    {
        return view('pelanggan.reservasi');
    }

    public function store(Request $request)
    {
        // Validate the form data
        $validated = $request->validate([
            'id_customer' => 'required|exists:customers,id_customer',
            'tujuan' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'tanggal_reservasi' => 'required|date',
        ]);

        // Create a new reservation
        Reservasi::create($validated);

        // Redirect back with a success message
        return redirect()->route('pelanggan.reservasi')->with('success', 'Reservasi berhasil dibuat!');
    }

    // Add a method for the dashboard page
public function dashboard()
{
    $user = Auth::user();

    $reservasis = Reservasi::where('id_user', $user->id)
        ->with([ 'detailReservasi']) // opsional: eager load semua
        ->latest()
        ->get();

    return view('pelanggan.dashboard', compact('reservasis'));
}



}
