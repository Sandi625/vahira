<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailReservasi extends Model
{
    use HasFactory;

    protected $table = 'detail_reservasi';
    protected $primaryKey = 'id'; // Sesuai dengan $table->id('id')

    // Kolom yang bisa diisi secara massal
    protected $fillable = [
        'id_reservasi',
        'nama_customer',
        // 'tujuan',
        'no_hp',
        'alamat_penjemputan',
    ];

    // Relasi ke model Reservasi
    public function reservasi()
    {
        return $this->belongsTo(Reservasi::class, 'id_reservasi', 'id_reservasi');
    }

    public function penumpangs()
{
    return $this->hasMany(Penumpang::class, 'id_detail_reservasi', 'id');
}

}
