<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Paket;

class PaketSeeder extends Seeder
{
    public function run(): void
    {
        Paket::insert([
            [
                'nama_paket' => 'Paket Ijen Sunrise',
                'deskripsi' => 'Menikmati keindahan sunrise di Kawah Ijen.',
                'harga' => 350000,
                'kuota' => 20,
                'foto' => 'paket/ijen-sunrise.jpg',
                'status' => Paket::STATUS_KOUTA_TERSEDIA,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_paket' => 'Paket Bromo Midnight',
                'deskripsi' => 'Petualangan seru ke Bromo dari tengah malam.',
                'harga' => 400000,
                'kuota' => 0,
                'foto' => 'paket/bromo-midnight.jpg',
                'status' => Paket::STATUS_KOUTA_PENUH,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_paket' => 'Paket City Tour Banyuwangi',
                'deskripsi' => 'Keliling kota Banyuwangi seharian penuh.',
                'harga' => 250000,
                'kuota' => 8,
                'foto' => 'paket/city-tour.jpg',
                'status' => Paket::STATUS_BERANGKAT_TANPA_PENUH,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
