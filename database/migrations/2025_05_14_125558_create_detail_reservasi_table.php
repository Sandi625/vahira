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
        Schema::create('detail_reservasi', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('id_reservasi');
            $table->string('nama_customer')->nullable();
            // $table->string('tujuan')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('alamat_penjemputan')->nullable();
            $table->timestamps();

            $table->foreign('id_reservasi')->references('id_reservasi')->on('reservasis')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
