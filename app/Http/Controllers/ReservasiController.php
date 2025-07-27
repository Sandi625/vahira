<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Paket;
use App\Models\Reservasi;
use Illuminate\Http\Request;
use App\Models\DetailReservasi;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class ReservasiController extends Controller
{
    // Tampilkan semua data reservasi
    public function index()
    {
        $reservasis = Reservasi::with('user', 'detailReservasi')->latest()->get();
        return view('reservasi.index', compact('reservasis'));
    }

    public function show($id)
    {
        $reservasi = Reservasi::with('user', 'detailReservasi')->findOrFail($id);
        return view('reservasi.show', compact('reservasi'));
    }





    // Tampilkan form tambah reservasi
    public function create()
    {
        $users = User::all();
        $pakets = Paket::all(); // pastikan ini ada

        return view('reservasi.create', compact('users', 'pakets'));
    }

    // Simpan data reservasi baru
    public function store(Request $request)
    {
        $request->validate([
            'id_user' => 'required|exists:users,id',
            'id_paket' => 'required|exists:pakets,id',
            'nama_pelanggan' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'alamat' => 'required|string|max:255',
            'jumlah_pembayaran' => 'required|numeric',
            'metode_pembayaran' => 'required|in:CASH,TRANSFER',
            'tanggal_pesan' => 'required|date',
            'tanggal_berangkat' => 'required|date|after_or_equal:tanggal_pesan',
            'bukti_pembayaran' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',

            'detail' => 'nullable|array',
            'detail.*.nama_customer' => 'required|string|max:255',
            // 'detail.*.tujuan' => 'nullable|string|max:255',
            'detail.*.no_hp' => 'nullable|string|max:20',
            'detail.*.alamat_penjemputan' => 'nullable|string|max:255',
        ]);

        // Hitung jumlah penumpang: 1 untuk pendaftar utama
        $jumlahPenumpang = 1;
        $validDetails = collect($request->input('detail'))->filter(function ($item) {
            return !empty($item['nama_customer']);
        });

        $jumlahPenumpang += $validDetails->count();

        // Log jumlah penumpang dan isi detail
        Log::info('Jumlah penumpang total: ' . $jumlahPenumpang);
        Log::info('Detail pelanggan valid:', $validDetails->toArray());

        // Ambil paket
        $paket = \App\Models\Paket::findOrFail($request->id_paket);

        Log::info('Kuota sebelum dikurangi: ' . $paket->kuota);

        // Cek apakah kuota mencukupi
        if ($paket->kuota < $jumlahPenumpang) {
            Log::warning("Kuota tidak cukup. Diperlukan: $jumlahPenumpang, Tersedia: {$paket->kuota}");
            return back()->withErrors(['kuota' => "Kuota tidak mencukupi untuk $jumlahPenumpang orang."])->withInput();
        }

        // Upload bukti pembayaran jika ada
        $buktiPath = null;
        if ($request->hasFile('bukti_pembayaran')) {
            $buktiPath = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');
        }

        // Simpan reservasi utama
        $reservasi = \App\Models\Reservasi::create([
            'id_user' => $request->id_user,
            'id_paket' => $request->id_paket,
            'nama_pelanggan' => $request->nama_pelanggan,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat, // <-- tambahkan ini
            'jumlah_pembayaran' => $request->jumlah_pembayaran,
            'metode_pembayaran' => $request->metode_pembayaran,
            'tanggal_pesan' => $request->tanggal_pesan,
            'tanggal_berangkat' => $request->tanggal_berangkat,
            'bukti_pembayaran' => $buktiPath,
            'status' => 'SEDANG DIPROSES',
        ]);

        // Simpan detail pelanggan
        foreach ($validDetails as $item) {
            \App\Models\DetailReservasi::create([
                'id_reservasi' => $reservasi->id_reservasi,
                'nama_customer' => $item['nama_customer'],
                // 'tujuan' => $item['tujuan'] ?? null,
                'no_hp' => $item['no_hp'] ?? null,
                'alamat_penjemputan' => $item['alamat_penjemputan'] ?? null,
            ]);
        }

        // Update kuota
        $paket->kuota = max(0, $paket->kuota - $jumlahPenumpang);
        Log::info("Kuota dikurangi sebanyak $jumlahPenumpang, sisa kuota: " . $paket->kuota);

        if ($paket->kuota === 0) {
            $paket->status = \App\Models\Paket::STATUS_KOUTA_PENUH;
            Log::info("Status paket diubah menjadi KOUTA_PENUH");
        }

        $paket->save();

        return redirect()->route('reservasi.index')->with('success', 'Reservasi berhasil ditambahkan.');
    }









    // Tampilkan detail satu reservasi
    // public function show($id)
    // {
    //     $reservasi = Reservasi::with('user', 'detailReservasi')->findOrFail($id);
    //     return view('reservasi.show', compact('reservasi'));
    // }

    // Tampilkan form edit
    public function edit($id)
    {
        $reservasi = Reservasi::with('detailReservasi')->findOrFail($id);
        $users = User::all();
        $pakets = Paket::all();

        return view('reservasi.edit', compact('reservasi', 'users', 'pakets'));
    }


    // Update data reservasi
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_user' => 'required|exists:users,id',
            'id_paket' => 'required|exists:pakets,id', // ✅ Tambahkan validasi id_paket
            'nama_pelanggan' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'alamat' => 'required|string|max:255',
            'jumlah_pembayaran' => 'required|numeric',
            'metode_pembayaran' => 'required|in:CASH,TRANSFER',
            'tanggal_pesan' => 'required|date',
            'tanggal_berangkat' => 'required|date|after_or_equal:tanggal_pesan',
            'bukti_pembayaran' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',

            'status' => 'nullable|in:DITERIMA,SEDANG DIPROSES,DITOLAK',

            'detail.nama_customer' => 'required|string|max:255',
            // 'detail.tujuan' => 'nullable|string|max:255',
            'detail.no_hp' => 'nullable|string|max:20',
            'detail.alamat_penjemputan' => 'nullable|string|max:255',
        ]);

        $reservasi = Reservasi::findOrFail($id);

        $paketLama = $reservasi->paket;
        $paketBaru = Paket::findOrFail($request->id_paket);

        // Ambil detail sebelumnya dan bandingkan jumlah penumpang
        $jumlahPenumpangLama = $reservasi->detailReservasi()->count();
        $jumlahPenumpangBaru = 1; // asumsinya hanya satu detail dikirim (form edit satu penumpang)

        // Jika ganti paket atau jumlah penumpang berubah
        if ($paketLama->id !== $paketBaru->id) {
            $paketLama->increment('kuota', $jumlahPenumpangLama); // kembalikan ke kuota lama
            if ($paketBaru->kuota < $jumlahPenumpangBaru) {
                return back()->withErrors(['kuota' => 'Kuota tidak mencukupi di paket yang dipilih.']);
            }
            $paketBaru->decrement('kuota', $jumlahPenumpangBaru);
        }

        // Upload bukti baru jika ada
        if ($request->hasFile('bukti_pembayaran')) {
            $buktiPath = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');
            $reservasi->bukti_pembayaran = $buktiPath;
        }

        // Update data utama
        $reservasi->id_user = $request->id_user;
        $reservasi->id_paket = $request->id_paket;
        $reservasi->nama_pelanggan = $request->nama_pelanggan;
        $reservasi->no_hp = $request->no_hp;
        $reservasi->alamat = $request->alamat; // <-- tambahkan ini
        $reservasi->jumlah_pembayaran = $request->jumlah_pembayaran;
        $reservasi->metode_pembayaran = $request->metode_pembayaran;
        $reservasi->tanggal_pesan = $request->tanggal_pesan;
        $reservasi->tanggal_berangkat = $request->tanggal_berangkat;

        if ($request->has('status')) {
            $reservasi->status = $request->status;
        }

        $reservasi->save();

        // Update atau buat detail
        $detail = $reservasi->detailReservasi()->first();

        $detailData = [
            'nama_customer' => $request->input('detail.nama_customer'),
            // 'tujuan' => $request->input('detail.tujuan'),
            'no_hp' => $request->input('detail.no_hp'),
            'alamat_penjemputan' => $request->input('detail.alamat_penjemputan'),
        ];

        if ($detail) {
            $detail->update($detailData);
        } else {
            DetailReservasi::create(array_merge($detailData, [
                'id_reservasi' => $reservasi->id_reservasi
            ]));
        }

        return redirect()->route('reservasi.index')->with('success', 'Reservasi berhasil diperbarui.');
    }




    // Hapus reservasi
    public function destroy($id)
    {
        $reservasi = Reservasi::findOrFail($id);
        $reservasi->delete();

        return redirect()->route('reservasi.index')->with('success', 'Reservasi berhasil dihapus.');
    }


    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:DITERIMA,DITOLAK',
        ]);

        $reservasi = Reservasi::findOrFail($id);
        $reservasi->status = $request->status;
        $reservasi->save();

        return redirect()->route('reservasi.index')->with('success', 'Status reservasi diperbarui.');
    }


  public function konfirmasi(Request $request, $id)
{
    $request->validate([
        'status' => 'required|in:DITERIMA,DITOLAK'
    ]);

    $reservasi = Reservasi::with(['paket', 'detailReservasi'])->findOrFail($id);
    $oldStatus = $reservasi->status;

    $reservasi->status = $request->status;
    $reservasi->save();
    $reservasi->refresh();

    // ✅ Kurangi kuota jika status DITERIMA dan sebelumnya bukan DITERIMA
    if ($request->status === 'DITERIMA' && $oldStatus !== 'DITERIMA') {
        $paket = $reservasi->paket;
        $jumlahPenumpang = $reservasi->detailReservasi->count();

        if ($paket->kuota >= $jumlahPenumpang) {
            $paket->kuota -= $jumlahPenumpang;

            if ($paket->kuota === 0) {
                $paket->status = Paket::STATUS_KOUTA_PENUH; // Pastikan konstanta ini ada
            }

            $paket->save();
        } else {
            // Jika somehow kuota tidak cukup, kembalikan error
            return back()->withErrors([
                'kuota' => "Kuota tidak mencukupi untuk $jumlahPenumpang penumpang."
            ]);
        }
    }

    // WA message
    if ($request->status === 'DITERIMA') {
        $pesan = "Halo *{$reservasi->nama_pelanggan}*,\n\nReservasi Anda telah *DITERIMA* oleh tim kami. Kami akan segera memproses dan menghubungi Anda untuk informasi lebih lanjut.\n\nSalam hangat dari *Bintoro Tour Travel* 😊";
    } else {
        $pesan = "Halo *{$reservasi->nama_pelanggan}*,\n\nMohon maaf, reservasi Anda *DITOLAK* karena alasan tertentu. Silakan hubungi kami kembali jika Anda membutuhkan bantuan lebih lanjut.\n\nSalam hangat dari *Bintoro Tour Travel* 🙏";
    }

    $this->kirimNotifikasiWhatsAppFonnte($reservasi->no_hp, $pesan);

    return redirect()->route('reservasi.show', $reservasi->id_reservasi)
        ->with('success', 'Status berhasil diperbarui.');
}




    protected function kirimNotifikasiWhatsAppFonnte($nomorTujuan, $pesan)
    {
        if (!env('FONTE_ENABLED', false)) {
            Log::info('Fitur Fonnte dinonaktifkan, notifikasi tidak dikirim.');
            return;
        }

        $apiKey = env('FONTE_API_KEY');
        $nomorTujuan = preg_replace('/^0/', '62', $nomorTujuan); // Format nomor Indonesia

        try {
            $response = Http::withHeaders([
                'Authorization' => $apiKey, // Jangan pakai "Bearer"
            ])->post('https://api.fonnte.com/send', [
                'target'  => $nomorTujuan,
                'message' => $pesan,
            ]);

            if ($response->successful()) {
                Log::info('Notifikasi WhatsApp berhasil dikirim.', ['response' => $response->json()]);
            } else {
                Log::error('Gagal mengirim notifikasi WhatsApp.', [
                    'status' => $response->status(),
                    'body'   => $response->body()
                ]);
            }
        } catch (\Exception $e) {
            Log::error('Exception saat kirim ke Fonnte: ' . $e->getMessage());
        }
    }
}
