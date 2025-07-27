<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;

    // Nama tabel jika berbeda dari default ('banks')
    protected $table = 'banks';

    // Kolom yang boleh diisi secara mass-assignment
    protected $fillable = [
        'nama_bank',
        'nomor_rekening',
        'nama_pemilik',
        'logo_bank',
    ];

    /**
     * Relasi ke pembayaran (jika ada)
     * Satu bank bisa dipakai di banyak pembayaran
     */
    public function pembayarans()
    {
        return $this->hasMany(Pembayaran::class, 'id_bank');
    }
}
