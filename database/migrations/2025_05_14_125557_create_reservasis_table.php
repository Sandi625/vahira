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
    $table->unsignedBigInteger('id_customer')->nullable();
    $table->string('tujuan')->nullable();
    $table->string('no_hp')->nullable();
    $table->date('tanggal_reservasi');

    $table->timestamps();

    $table->foreign('id_customer')->references('id_customer')->on('customers')->onDelete('cascade');
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
