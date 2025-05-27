<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;
use App\Models\Customer;
use Illuminate\Http\Request;

class ReservasiController extends Controller
{
    public function index()
    {
        $reservasis = Reservasi::with('customer')->get();
        return view('reservasi.index', compact('reservasis'));
    }

    public function create()
    {
        $customers = Customer::all();
        return view('reservasi.create', compact('customers'));
    }

 public function store(Request $request)
{
    $validatedData = $request->validate([
        'id_customer' => 'required|exists:customers,id_customer',
        'tujuan' => 'nullable|string|max:255',
        'no_hp' => 'nullable|string|max:20',
        'tanggal_reservasi' => 'required|date',
    ]);

    Reservasi::create($validatedData);

    return redirect()->route('reservasi.index')->with('success', 'Data reservasi berhasil ditambahkan.');
}



    public function edit($id)
    {
        $reservasi = Reservasi::findOrFail($id);
        $customers = Customer::all();
        return view('reservasi.edit', compact('reservasi', 'customers'));
    }

public function update(Request $request, $id)
{
    $validatedData = $request->validate([
        'id_customer' => 'required|exists:customers,id_customer',
        'tujuan' => 'nullable|string|max:255',
        'no_hp' => 'nullable|string|max:20',
        'tanggal_reservasi' => 'required|date',
    ]);

    $reservasi = Reservasi::findOrFail($id);
    $reservasi->update($validatedData);

    return redirect()->route('reservasi.index')->with('success', 'Data reservasi berhasil diperbarui.');
}



    public function destroy($id)
    {
        $reservasi = Reservasi::findOrFail($id);
        $reservasi->delete();

        return redirect()->route('reservasi.index')->with('success', 'Data reservasi berhasil dihapus.');
    }
}
