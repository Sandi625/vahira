<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penumpang extends Model
{
    protected $table = 'penumpangs';
    protected $primaryKey = 'id_pelanggan';

    protected $fillable = ['id_reservasi', 'id_detail_reservasi'];

    public function reservasi()
    {
        return $this->belongsTo(Reservasi::class, 'id_reservasi', 'id_reservasi');
    }

  public function detailReservasi()
{
    return $this->belongsTo(DetailReservasi::class, 'id_detail_reservasi', 'id');
}
}

