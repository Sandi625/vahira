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
        $table->unsignedBigInteger('id_detail_reservasi')->nullable(); // opsional relasi tambahan
        $table->timestamps();

        $table->foreign('id_reservasi')->references('id_reservasi')->on('reservasis')->onDelete('cascade');
        $table->foreign('id_detail_reservasi')->references('id')->on('detail_reservasi')->onDelete('set null');
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
