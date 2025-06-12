<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    use HasFactory;

    protected $table = 'reservasis'; // Nama tabel
    protected $primaryKey = 'id_reservasi'; // Kunci utama

    protected $fillable = [
        'id_customer',
        'tujuan',
        'no_hp',
        'tanggal_reservasi',
    ];

    protected $casts = [
        'tanggal_reservasi' => 'date',
    ];

    // Relasi dengan Customer
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id_customer', 'id_customer');
    }

}

