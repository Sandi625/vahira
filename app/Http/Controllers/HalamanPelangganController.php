<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;
use App\Models\Reservation; // Assuming you have a Reservation model
use Illuminate\Http\Request;

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
        // You can pass any required data to the view here
        return view('pelanggan.dashboard');
    }
}
