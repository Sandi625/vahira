<?php



namespace App\Http\Controllers;

use App\Models\Reservasi;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;


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
        'id_reservasi'       => 'required|exists:reservasis,id_reservasi',
        'jumlah_pembayaran'  => 'required|numeric',
        'metode_pembayaran'  => 'required|in:CASH,TRANSFER',
        'status_pembayaran'  => 'required|in:DITERIMA,TIDAK DITERIMA',
        'tanggal_pembayaran' => 'required|date',
    ]);

    // Simpan data pembayaran
    $pembayaran = Pembayaran::create($request->all());

    // Ambil data reservasi
    $reservasi = Reservasi::find($request->id_reservasi);

    if ($reservasi && $reservasi->no_hp) {
        $pesan = "Halo {$reservasi->nama_customer}, pembayaran sebesar Rp " . number_format($request->jumlah_pembayaran, 0, ',', '.') .
                 " untuk reservasi tujuan {$reservasi->tujuan} telah kami terima. Terima kasih 🙏.";

        $this->kirimNotifikasiWhatsAppFonte($reservasi->no_hp, $pesan);
    }

    return redirect()->route('pembayaran.index')->with('success', 'Data pembayaran berhasil ditambahkan dan notifikasi dikirim.');
}


protected function kirimNotifikasiWhatsAppFonte($nomorTujuan, $pesan)
{
    $apiKey = 'rtz7dDtCCpoKDf76rBZe';
    $nomorTujuan = preg_replace('/^0/', '62', $nomorTujuan); // Format nomor

    $response = Http::withHeaders([
        'Authorization' => $apiKey,
        'Accept' => 'application/json',
    ])->post('https://api.fonte.com/send-message', [
        'receiver' => $nomorTujuan,
        'message' => $pesan,
        // 'type' => 'text', // tambahkan jika diperlukan oleh API Fonte
    ]);

    if ($response->successful()) {
        Log::info('Notifikasi WhatsApp berhasil dikirim.', ['response' => $response->json()]);
    } else {
        Log::error('Gagal mengirim notifikasi WhatsApp.', [
            'status' => $response->status(),
            'body' => $response->body()
        ]);
    }
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
