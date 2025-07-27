<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
            'kuota'      => 'required|integer|min:0',
            'foto'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status'     => [
                'nullable',
                Rule::in([
                    Paket::STATUS_KOUTA_TERSEDIA,
                    Paket::STATUS_KOUTA_PENUH,
                    Paket::STATUS_BERANGKAT_TANPA_PENUH,
                ]),
            ],
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
            'kuota'      => 'required|integer|min:0',
            'foto'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status'     => [
                'required',
                Rule::in([
                    Paket::STATUS_KOUTA_TERSEDIA,
                    Paket::STATUS_KOUTA_PENUH,
                    Paket::STATUS_BERANGKAT_TANPA_PENUH,
                ]),
            ],
        ]);

        if ($request->hasFile('foto')) {
            if ($paket->foto && file_exists(public_path($paket->foto))) {
                unlink(public_path($paket->foto));
            }

            $foto = $request->file('foto');
            $namaFoto = time() . '_' . $foto->getClientOriginalName();
            $foto->move(public_path('uploads/pakets'), $namaFoto);
            $validatedData['foto'] = 'uploads/pakets/' . $namaFoto;
        } else {
            $validatedData['foto'] = $paket->foto;
        }

        $paket->update($validatedData);

        return redirect()->route('pakets.index')->with('success', 'Paket berhasil diperbarui.');
    }

    public function destroy(Paket $paket)
    {
        if ($paket->foto && file_exists(public_path($paket->foto))) {
            unlink(public_path($paket->foto));
        }

        $paket->delete();
        return redirect()->route('pakets.index')->with('success', 'Paket berhasil dihapus.');
    }
}
