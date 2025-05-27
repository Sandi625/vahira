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
    Schema::create('pesanan', function (Blueprint $table) {
        $table->id(); // id pesanan
        $table->unsignedBigInteger('id_paket');
        $table->string('nama', 255); // nama pemesan, wajib diisi

        $table->date('tanggal_reservasi');
        // $table->integer('jumlah_orang')->default(1);
        $table->string('no_hp', 20)->nullable();
        $table->string('foto')->nullable(); // upload bukti pembayaran

        $table->timestamps();

        $table->foreign('id_paket')->references('id')->on('pakets')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanans');
    }
};
