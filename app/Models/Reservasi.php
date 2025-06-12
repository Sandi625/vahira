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
        'nama_customer',
        'tujuan',
        'no_hp',
        'tanggal_reservasi',
        'bukti_pembayaran',
        'id_user',
    ];

    protected $casts = [
        'tanggal_reservasi' => 'date',
    ];

    // Relasi dengan Customer
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id_customer', 'id_customer');
    }

    public function user()
{
    return $this->belongsTo(User::class, 'id_user');
}




}

