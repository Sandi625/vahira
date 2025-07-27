<?php

namespace App\Http\Controllers;

use App\Models\Penumpang;
use App\Models\Reservasi;
use App\Models\DetailReservasi;
use Illuminate\Http\Request;

class PenumpangController extends Controller
{
    public function index()
    {
        $reservasis = Reservasi::with(['detailReservasi', 'paket'])->paginate(5);
        return view('penumpang.index', compact('reservasis'));
    }











    public function create()
    {
        $reservasis = Reservasi::with('customer')->get();
        $detailReservasis = DetailReservasi::all();
        return view('penumpang.create', compact('reservasis', 'detailReservasis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_reservasi' => 'required|exists:reservasis,id_reservasi',
            'id_detail_reservasi' => 'nullable|exists:detail_reservasi,id',
        ]);

        Penumpang::create([
            'id_reservasi' => $request->id_reservasi,
            'id_detail_reservasi' => $request->id_detail_reservasi,
        ]);

        return redirect()->route('penumpang.index')->with('success', 'Data penumpang berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $penumpang = Penumpang::findOrFail($id);
        $reservasis = Reservasi::all();
        $detailReservasis = DetailReservasi::all();

        return view('penumpang.edit', compact('penumpang', 'reservasis', 'detailReservasis'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_reservasi' => 'required|exists:reservasis,id_reservasi',
            'id_detail_reservasi' => 'nullable|exists:detail_reservasi,id',
        ]);

        $penumpang = Penumpang::findOrFail($id);
        $penumpang->update([
            'id_reservasi' => $request->id_reservasi,
            'id_detail_reservasi' => $request->id_detail_reservasi,
        ]);

        return redirect()->route('penumpang.index')->with('success', 'Data penumpang berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $penumpang = Penumpang::findOrFail($id);
        $penumpang->delete();

        return redirect()->route('penumpang.index')->with('success', 'Data penumpang berhasil dihapus.');
    }
}
