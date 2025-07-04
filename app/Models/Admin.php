<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected $table = 'admins'; // Nama tabel
    protected $primaryKey = 'id_admin'; // Kunci utama
    protected $fillable = [
        'nama_admin',
        'email',
        'password',
        'user_id',
    ];

    // Jika Anda menggunakan hashing untuk password, pastikan untuk meng-hash password sebelum menyimpannya
    public static function boot()
    {
        parent::boot();

        static::creating(function ($admin) {
            $admin->password = bcrypt($admin->password); // Meng-hash password
        });
    }

    public function user()
{
    return $this->belongsTo(User::class);
}

}
