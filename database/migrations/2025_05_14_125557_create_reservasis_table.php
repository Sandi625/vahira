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

        $table->unsignedBigInteger('id_user');    // relasi ke users
        $table->unsignedBigInteger('id_paket');   // relasi ke pakets

        $table->string('nama_pelanggan');
        $table->string('alamat');
        $table->string('no_hp')->nullable();
        // $table->string('jumlah_pembayaran');
        // $table->string('metode_pembayaran');
        $table->string('tanggal_pesan');
        $table->string('tanggal_berangkat');
        // $table->string('bukti_pembayaran')->nullable();
        $table->enum('status', ['DITERIMA', 'SEDANG DIPROSES', 'DITOLAK'])->nullable();

        // ✅ Tambahan kolom peran
        $table->enum('peran', ['PEMESAN_SAJA', 'PEMESAN_DAN_PENUMPANG'])->default('PEMESAN_SAJA');

        $table->timestamps();

        $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
        $table->foreign('id_paket')->references('id')->on('pakets')->onDelete('cascade');
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
