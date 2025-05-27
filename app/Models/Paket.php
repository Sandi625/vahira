<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    use HasFactory;

    protected $table = 'pakets'; // nama tabel di database

    protected $primaryKey = 'id'; // kolom primary key

    protected $fillable = [
        'nama_paket',
        'deskripsi',
        'harga',
        'foto',
        'status',
    ];
}
