<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuktiTf extends Model
{
    use HasFactory;

    protected $table = 'bukti_tf';

    protected $primaryKey = 'id';

    protected $fillable = [
        'bank_id',
        'user_id',            // tambahkan ini
        'nama_pengirim',
        'jumlah_transfer',
        'bukti_transfer',
        'catatan',
    ];

    /**
     * Relasi ke model Bank.
     */
    public function bank()
    {
        return $this->belongsTo(Bank::class, 'bank_id');
    }

    /**
     * Relasi ke model User.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
