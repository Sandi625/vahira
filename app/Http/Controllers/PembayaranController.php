<?php



namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Reservasi;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function index()
{
    $pembayarans = Pembayaran::with('reservasi.customer')->get();
    return view('pembayaran.index', compact('pembayarans'));
}


   public function create()
{
    $reservasis = Reservasi::with('customer')->get();
    return view('pembayaran.create', compact('reservasis'));
}

    public function store(Request $request)
    {
        $request->validate([
            'id_reservasi' => 'required|exists:reservasis,id_reservasi',
            'jumlah_pembayaran' => 'required|numeric',
            'metode_pembayaran' => 'required|in:CASH,TRANSFER',
            'status_pembayaran' => 'required|in:DITERIMA,TIDAK DITERIMA',
            'tanggal_pembayaran' => 'required|date',
        ]);

        Pembayaran::create($request->all());

        return redirect()->route('pembayaran.index')->with('success', 'Data pembayaran berhasil ditambahkan.');
    }

   public function edit($id)
{
    $pembayaran = Pembayaran::with('reservasi.customer')->findOrFail($id);
    $reservasis = Reservasi::with('customer')->get();
    return view('pembayaran.edit', compact('pembayaran', 'reservasis'));
}


    public function update(Request $request, $id)
    {
        $request->validate([
            'id_reservasi' => 'required|exists:reservasis,id_reservasi',
            'jumlah_pembayaran' => 'required|numeric',
            'metode_pembayaran' => 'required|in:CASH,TRANSFER',
            'status_pembayaran' => 'required|in:DITERIMA,TIDAK DITERIMA',
            'tanggal_pembayaran' => 'required|date',
        ]);

        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->update($request->all());

        return redirect()->route('pembayaran.index')->with('success', 'Data pembayaran berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->delete();

        return redirect()->route('pembayaran.index')->with('success', 'Data pembayaran berhasil dihapus.');
    }
}
