<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Paket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\PesananBaruMail;


class PesananController extends Controller
{
    public function index()
    {
        $pesanans = Pesanan::with('paket')->latest()->get();
        return view('pesanan.index', compact('pesanans'));
    }

    public function create()
    {
        $pakets = Paket::where('status', 1)->get();
        return view('pesanan.create', compact('pakets'));
    }

   public function store(Request $request)
{
    $validated = $request->validate([
        'id_paket' => 'required|exists:pakets,id',
        'nama' => 'required|string|max:255',
        'tanggal_reservasi' => 'required|date',
        'no_hp' => 'nullable|string|max:20',
        'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        // 'jumlah_orang' => 'required|integer|min:1',
    ]);

    if ($request->hasFile('foto')) {
        $file = $request->file('foto');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads/pesanan'), $filename);
        $validated['foto'] = 'uploads/pesanan/' . $filename;
    }

    Pesanan::create($validated);

    // Kirim email notifikasi
    Mail::to('vahiragestalia1212@gmail.com')->send(new PesananBaruMail($validated));

return redirect()->route('pelanggan.index')->with('success', 'Berhasil memesan paket trip');
}




    public function edit($id)
    {
        $pesanan = Pesanan::findOrFail($id);
        $pakets = Paket::where('status', 1)->get();
        return view('pesanan.edit', compact('pesanan', 'pakets'));
    }

    public function update(Request $request, $id)
    {
        $pesanan = Pesanan::findOrFail($id);

        $validated = $request->validate([
            'id_paket' => 'required|exists:pakets,id',
            'tanggal_reservasi' => 'required|date',
            // 'tujuan' => 'nullable|string|max:255',
            'no_hp' => 'nullable|string|max:20',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'nullable|boolean',
        ]);

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($pesanan->foto && file_exists(public_path($pesanan->foto))) {
                unlink(public_path($pesanan->foto));
            }

            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/pesanan'), $filename);
            $validated['foto'] = 'uploads/pesanan/' . $filename;
        } else {
            unset($validated['foto']);
        }

        $pesanan->update($validated);

        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil diperbarui.');
    }

   public function destroy($id)
{
    $pesanan = Pesanan::findOrFail($id);

    // Hapus file foto jika ada
    if ($pesanan->foto && file_exists(public_path($pesanan->foto))) {
        unlink(public_path($pesanan->foto));
    }

    $pesanan->delete();

    return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil dihapus.');
}

}
