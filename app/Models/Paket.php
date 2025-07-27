<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    use HasFactory;

    protected $table = 'pakets';
    protected $primaryKey = 'id';

    // ✅ Status enum yang tersedia
    public const STATUS_KOUTA_TERSEDIA = 'KOUTA_TERSEDIA';
    public const STATUS_KOUTA_PENUH = 'KOUTA_PENUH';
    public const STATUS_BERANGKAT_TANPA_PENUH = 'BERANGKAT_TANPA_PENUH';

    protected $fillable = [
        'nama_paket',
        'deskripsi',
        'harga',
        'kuota',
        'foto',
        'status',
    ];

    // ✅ Relasi ke tabel reservasis
    public function reservasis()
    {
        return $this->hasMany(Reservasi::class, 'id_paket');
    }

    // ✅ Opsional: Label status untuk tampilan (misalnya di tabel atau UI)
    public function getStatusLabelAttribute()
    {
        return match ($this->status) {
            self::STATUS_KOUTA_TERSEDIA => 'Kuota Tersedia',
            self::STATUS_KOUTA_PENUH => 'Kuota Penuh',
            self::STATUS_BERANGKAT_TANPA_PENUH => 'Berangkat (Tidak Penuh)',
            default => 'Tidak Diketahui',
        };
    }
}
