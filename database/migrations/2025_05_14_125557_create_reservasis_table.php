<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up(): void
{
    Schema::create('reservasis', function (Blueprint $table) {
        $table->id('id_reservasi');

        $table->unsignedBigInteger('id_customer')->nullable(); // tetap dipertahankan
        $table->unsignedBigInteger('id_user'); // kolom relasi ke users

        $table->string('nama_customer')->nullable();
        $table->string('tujuan')->nullable();
        $table->string('no_hp')->nullable();
        $table->date('tanggal_reservasi');
        $table->string('bukti_pembayaran')->nullable();

        $table->timestamps();

        $table->foreign('id_customer')->references('id_customer')->on('customers')->onDelete('cascade');
        $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade'); // relasi ke users
    });
}



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservasis');
    }
};
