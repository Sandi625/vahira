<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customers'; // Nama tabel
    protected $primaryKey = 'id_customer'; // Kunci utama
    protected $fillable = [
        'id_admin',
        'nama_customer',
        'email_customer',
        'password',
    ];

    // Relasi dengan model Admin
    public function admin()
    {
        return $this->belongsTo(Admin::class, 'id_admin', 'id_admin');
    }

    // Jika Anda menggunakan hashing untuk password, pastikan untuk meng-hash password sebelum menyimpannya
    public static function boot()
    {
        parent::boot();

        static::creating(function ($customer) {
            $customer->password = bcrypt($customer->password); // Meng-hash password
        });
    }
}
