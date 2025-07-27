<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    use HasFactory;

    protected $table = 'reservasis';
    protected $primaryKey = 'id_reservasi';

    protected $fillable = [
        'id_user',
        'id_paket',
        'nama_pelanggan',
        'no_hp',
        'alamat',
        'tanggal_pesan',
        'tanggal_berangkat',
        'status',
        'peran', // ✅ Tetap disertakan karena masih digunakan
    ];

    protected $casts = [
        'tanggal_pesan' => 'date',
        'tanggal_berangkat' => 'date',
    ];

    // Relasi ke tabel users
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    // Relasi ke tabel pakets
    public function paket()
    {
        return $this->belongsTo(Paket::class, 'id_paket');
    }

    // Relasi ke detail_reservasis
    public function detailReservasi()
    {
        return $this->hasMany(DetailReservasi::class, 'id_reservasi', 'id_reservasi');
    }

    // Relasi ke tabel pembayaran
    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class, 'id_reservasi', 'id_reservasi');
    }

    // Relasi ke penumpang
    public function penumpangs()
    {
        return $this->hasMany(Penumpang::class, 'id_reservasi', 'id_reservasi');
    }
}

