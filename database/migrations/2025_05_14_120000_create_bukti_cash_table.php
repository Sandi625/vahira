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
    Schema::create('bukti_cash', function (Blueprint $table) {
        $table->id();

        // Menyimpan ID pengguna yang membayar
        $table->unsignedBigInteger('user_id');

        // Kolom jumlah pembayaran tunai sebagai integer
        $table->integer('total_bayar');

        // Kolom metode pembayaran, default: 'cash'
        $table->string('metode_pembayaran')->default('cash');

        $table->timestamps();

        // Foreign key ke tabel users
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    });
}



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bukti_cash');
    }
};
