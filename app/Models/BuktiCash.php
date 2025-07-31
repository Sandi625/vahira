<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuktiCash extends Model
{
    use HasFactory;

    // Nama tabel (opsional jika sudah sesuai konvensi)
    protected $table = 'bukti_cash';

    // Kolom yang dapat diisi (mass assignment)
    protected $fillable = [
        'user_id',            // ✅ Tambahan
        'total_bayar',
        'metode_pembayaran',
    ];


    public function user()
{
    return $this->belongsTo(User::class);
}

}
