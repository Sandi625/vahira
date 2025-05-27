<?php

namespace App\Http\Controllers;

use App\Models\Penumpang;
use App\Models\Reservasi;
use Illuminate\Http\Request;

class PenumpangController extends Controller
{
   public function index()
{
    $penumpangs = Penumpang::with('reservasi.customer')->get();

    return view('penumpang.index', compact('penumpangs'));
}


   public function create()
{
    $reservasis = Reservasi::with('customer')->get();

    return view('penumpang.create', compact('reservasis'));
}


    public function store(Request $request)
    {
        $request->validate([
            'id_reservasi' => 'required|exists:reservasis,id_reservasi',
            'nama' => 'required|string|max:100',
            'alamat' => 'required|string',
        ]);

        Penumpang::create($request->all());

        return redirect()->route('penumpang.index')->with('success', 'Data penumpang berhasil ditambahkan.');
    }

    public function edit($id)
{
    $penumpang = Penumpang::findOrFail($id);  // Ambil data Penumpang berdasarkan ID
    $reservasis = Reservasi::all();  // Ambil semua data Reservasi

    return view('penumpang.edit', compact('penumpang', 'reservasis'));
}


    public function update(Request $request, $id)
    {
        $request->validate([
            'id_reservasi' => 'required|exists:reservasis,id_reservasi',
            'nama' => 'required|string|max:100',
            'alamat' => 'required|string',
        ]);

        $penumpang = Penumpang::findOrFail($id);
        $penumpang->update($request->all());

        return redirect()->route('penumpang.index')->with('success', 'Data penumpang berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $penumpang = Penumpang::findOrFail($id);
        $penumpang->delete();

        return redirect()->route('penumpang.index')->with('success', 'Data penumpang berhasil dihapus.');
    }
}
