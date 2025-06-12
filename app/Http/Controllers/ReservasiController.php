<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Reservasi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
        'id_customer'        => 'nullable|exists:customers,id_customer',
        'nama_customer'      => 'nullable|string|max:100',
        'no_hp'              => 'nullable|string|max:20',
        'tujuan'             => 'nullable|string|max:255',
        'tanggal_reservasi'  => 'required|date',
        'bukti_pembayaran'   => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
    ]);

    if ($request->hasFile('bukti_pembayaran')) {
        $file = $request->file('bukti_pembayaran');
        $path = $file->store('bukti_pembayaran', 'public');
        $validatedData['bukti_pembayaran'] = $path;
    }

    // Jika ada kolom id_user untuk tracking siapa yang membuat
    $validatedData['id_user'] = Auth::id(); // opsional, sesuai struktur DB kamu

    try {
        Reservasi::create($validatedData);
        return redirect()->route('reservasi.index')->with('success', 'Data reservasi berhasil ditambahkan.');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Gagal menyimpan reservasi: ' . $e->getMessage());
    }
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
        'id_customer'        => 'nullable|exists:customers,id_customer',
        'nama_customer'      => 'nullable|string|max:100',
        'tujuan'             => 'nullable|string|max:255',
        'no_hp'              => 'nullable|string|max:20',
        'tanggal_reservasi'  => 'required|date',
        'bukti_pembayaran'   => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
    ]);

    $reservasi = Reservasi::findOrFail($id);

    if ($request->hasFile('bukti_pembayaran')) {
        if ($reservasi->bukti_pembayaran && Storage::disk('public')->exists($reservasi->bukti_pembayaran)) {
            Storage::disk('public')->delete($reservasi->bukti_pembayaran);
        }

        $file = $request->file('bukti_pembayaran');
        $path = $file->store('bukti_pembayaran', 'public'); // << path ini juga sama
        $validatedData['bukti_pembayaran'] = $path;
    }

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
