<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $table = 'pesanan';

    protected $fillable = [
        'id_paket',
        'nama',
        'tanggal_reservasi',
        // 'jumlah_orang',
        'no_hp',
        'foto',
    ];

    public function paket()
    {
        return $this->belongsTo(Paket::class, 'id_paket');
    }
}


