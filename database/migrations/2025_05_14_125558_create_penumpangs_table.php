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
    Schema::create('penumpangs', function (Blueprint $table) {
    $table->id('id_pelanggan');
    $table->unsignedBigInteger('id_reservasi');
    $table->string('nama');
    $table->string('alamat');
    $table->timestamps();

    $table->foreign('id_reservasi')->references('id_reservasi')->on('reservasis')->onDelete('cascade');
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penumpangs');
    }
};
