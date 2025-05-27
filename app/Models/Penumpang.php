<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penumpang extends Model
{
    use HasFactory;

    protected $table = 'penumpangs'; // Nama tabel
    protected $primaryKey = 'id_pelanggan'; // Kunci utama

    protected $fillable = [
        'id_reservasi',
        'nama',
        'alamat',
    ];

    // Relasi dengan Reservasi
    public function reservasi()
    {
        return $this->belongsTo(Reservasi::class, 'id_reservasi', 'id_reservasi');
    }
}
