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
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id('id_pembayaran');
            $table->unsignedBigInteger('id_reservasi');
            $table->decimal('jumlah_pembayaran', 15, 2);
            $table->enum('metode_pembayaran', ['CASH', 'TRANSFER']);
            $table->enum('status_pembayaran', ['DITERIMA', 'TIDAK DITERIMA'])->default('TIDAK DITERIMA');
            $table->date('tanggal_pembayaran');
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
