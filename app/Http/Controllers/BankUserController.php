<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\BuktiTF;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BankUserController extends Controller
{
    /**
     * Tampilkan daftar bank untuk user (frontend).
     */
    public function index()
    {
        $banks = Bank::latest()->get();
        return view('user.bank.index', compact('banks'));
    }


    public function create()
    {
        $banks = Bank::all(); // Ambil semua bank untuk dropdown
        return view('user.bukti_tf.create', compact('banks'));
    }

    /**
     * Simpan data bukti transfer.
     */

public function store(Request $request)
{
    $request->validate([
        'bank_id' => 'required|exists:banks,id',
        'nama_pengirim' => 'required|string|max:100',
        'jumlah_transfer' => 'required|integer|min:1',
        'bukti_transfer' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        'catatan' => 'nullable|string|max:255',
    ]);

    $bukti = new BuktiTf($request->except('bukti_transfer'));
    $bukti->user_id = Auth::id(); // Tambahkan user_id dari yang login

    if ($request->hasFile('bukti_transfer')) {
        $file = $request->file('bukti_transfer');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads/bukti_tf'), $filename);
        $bukti->bukti_transfer = 'uploads/bukti_tf/' . $filename;
    }

    $bukti->save();

    return redirect()->back()->with('success', 'Bukti transfer berhasil dikirim.');
}

}
