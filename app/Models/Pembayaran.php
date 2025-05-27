<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayarans'; // Nama tabel
    protected $primaryKey = 'id_pembayaran'; // Kunci utama

    protected $fillable = [
        'id_reservasi',
        'jumlah_pembayaran',
        'metode_pembayaran',
        'status_pembayaran',
        'tanggal_pembayaran',
    ];

    // Relasi dengan Reservasi
    public function reservasi()
    {
        return $this->belongsTo(Reservasi::class, 'id_reservasi', 'id_reservasi');
    }
}
