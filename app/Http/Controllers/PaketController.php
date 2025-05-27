<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PaketController extends Controller
{
    public function index()
    {
        $pakets = Paket::all();
        return view('pakets.index', compact('pakets'));
    }

    public function create()
    {
        return view('pakets.create');
    }

    public function store(Request $request)
{
    $validatedData = $request->validate([
        'nama_paket' => 'required|string|max:100',
        'deskripsi'  => 'nullable|string',
        'harga'      => 'required|numeric',
        'foto'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'status'     => 'nullable|boolean',
    ]);

    if ($request->hasFile('foto')) {
        $foto = $request->file('foto');
        $namaFoto = time() . '_' . $foto->getClientOriginalName();
        $foto->move(public_path('uploads/pakets'), $namaFoto);
        $validatedData['foto'] = 'uploads/pakets/' . $namaFoto;
    }

    Paket::create($validatedData);

    return redirect()->route('pakets.index')->with('success', 'Paket berhasil ditambahkan.');
}



    public function show(Paket $paket)
    {
        return view('pakets.show', compact('paket'));
    }

    public function edit(Paket $paket)
    {
        return view('pakets.edit', compact('paket'));
    }

 public function update(Request $request, $id)
{
    $paket = Paket::findOrFail($id);

    $validatedData = $request->validate([
        'nama_paket' => 'required|string|max:255',
        'deskripsi'  => 'nullable|string',
        'harga'      => 'required|numeric',
        'foto'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'status'     => 'required|boolean',
    ]);

    if ($request->hasFile('foto')) {
        // Hapus foto lama kalau ada
        if ($paket->foto && file_exists(public_path($paket->foto))) {
            unlink(public_path($paket->foto));
        }

        // Simpan foto baru ke public/uploads/pakets
        $foto = $request->file('foto');
        $namaFoto = time() . '_' . $foto->getClientOriginalName();
        $foto->move(public_path('uploads/pakets'), $namaFoto);
        $validatedData['foto'] = 'uploads/pakets/' . $namaFoto;
    } else {
        // Tetap gunakan foto lama jika tidak ada upload baru
        $validatedData['foto'] = $paket->foto;
    }

    $paket->update($validatedData);

    return redirect()->route('pakets.index')->with('success', 'Paket berhasil diperbarui.');
}




    public function destroy(Paket $paket)
    {
        $paket->delete();
        return redirect()->route('pakets.index')->with('success', 'Paket berhasil dihapus.');
    }
}
