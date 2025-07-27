<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::create('pakets', function (Blueprint $table) {
        $table->id(); // sudah auto-increment & primary key
        $table->string('nama_paket', 100);
        $table->text('deskripsi')->nullable();
        $table->unsignedInteger('harga'); // cukup seperti ini
        $table->unsignedInteger('kuota')->default(0); // ✅ Tambahan kolom kuota bangku penumpang
        $table->string('foto')->nullable();

        // ✅ Ubah status dari boolean ke enum
        $table->enum('status', [
            'KOUTA_TERSEDIA',
            'KOUTA_PENUH',
            'BERANGKAT_TANPA_PENUH'
        ])->nullable();

        $table->timestamps();
    });
}





    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pakets');
    }
};
