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

        // 🔽 Relasi baru ke bukti pembayaran
        $table->unsignedBigInteger('id_bukti_cash')->nullable();
        $table->unsignedBigInteger('id_bukti_tf')->nullable();

        $table->string('nama_pelanggan');
        $table->string('alamat');
        $table->string('no_hp')->nullable();
        $table->string('tanggal_pesan');
        $table->string('tanggal_berangkat');
        $table->enum('status', ['DITERIMA', 'SEDANG DIPROSES', 'DITOLAK'])->nullable();

        $table->enum('peran', ['PEMESAN_SAJA', 'PEMESAN_DAN_PENUMPANG'])->default('PEMESAN_SAJA');

        $table->timestamps();

        // 🔗 Foreign key
        $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
        $table->foreign('id_paket')->references('id')->on('pakets')->onDelete('cascade');
        $table->foreign('id_bukti_cash')->references('id')->on('bukti_cash')->onDelete('set null');
        $table->foreign('id_bukti_tf')->references('id')->on('bukti_tf')->onDelete('set null');
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
