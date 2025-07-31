<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\BuktiTf;

use App\Models\BuktiCash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class BankController extends Controller
{
    /**
     * Menampilkan daftar semua bank.
     */
    public function index()
    {
        $banks = Bank::latest()->get();
        return view('bank.index', compact('banks'));
    }

    /**
     * Tampilkan form untuk membuat bank baru.
     */
    public function create()
    {
        return view('bank.create');
    }

    /**
     * Simpan data bank baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_bank' => 'required|string|max:100',
            'nomor_rekening' => 'required|string|max:50',
            'nama_pemilik' => 'required|string|max:100',
            'logo_bank' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $bank = new Bank($request->except('logo_bank'));

        if ($request->hasFile('logo_bank')) {
            $file = $request->file('logo_bank');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/bank'), $filename);
            $bank->logo_bank = 'uploads/bank/' . $filename;
        }

        $bank->save();

        return redirect()->route('banks.index')->with('success', 'Bank berhasil ditambahkan.');
    }

    /**
     * Tampilkan detail bank tertentu (opsional).
     */
    public function show($id)
    {
        $bank = Bank::findOrFail($id);
        return view('bank.show', compact('bank'));
    }

    /**
     * Tampilkan form edit untuk bank tertentu.
     */
    public function edit($id)
    {
        $bank = Bank::findOrFail($id);
        return view('bank.edit', compact('bank'));
    }

    /**
     * Perbarui data bank tertentu.
     */
    public function update(Request $request, $id)
    {
        $bank = Bank::findOrFail($id);

        $request->validate([
            'nama_bank' => 'required|string|max:100',
            'nomor_rekening' => 'required|string|max:50',
            'nama_pemilik' => 'required|string|max:100',
            'logo_bank' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $bank->fill($request->except('logo_bank'));

        if ($request->hasFile('logo_bank')) {
            // Hapus file lama
            if ($bank->logo_bank && File::exists(public_path($bank->logo_bank))) {
                File::delete(public_path($bank->logo_bank));
            }

            $file = $request->file('logo_bank');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/bank'), $filename);
            $bank->logo_bank = 'uploads/bank/' . $filename;
        }

        $bank->save();

        return redirect()->route('banks.index')->with('success', 'Data bank berhasil diperbarui.');
    }

    /**
     * Hapus data bank dari database.
     */
    public function destroy($id)
    {
        $bank = Bank::findOrFail($id);

        if ($bank->logo_bank && File::exists(public_path($bank->logo_bank))) {
            File::delete(public_path($bank->logo_bank));
        }

        $bank->delete();

        return redirect()->route('banks.index')->with('success', 'Bank berhasil dihapus.');
    }

public function buktiTransfer()
{
    $buktiTransfers = BuktiTf::with(['bank', 'user'])->latest()->get();
    $buktiCash = BuktiCash::latest()->get(); // ambil semua data cash

    return view('user.bukti_tf.index', compact('buktiTransfers', 'buktiCash'));
}


}
