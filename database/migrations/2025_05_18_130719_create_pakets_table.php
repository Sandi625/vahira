<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::create('pakets', function (Blueprint $table) {
        $table->id(); // sudah auto-increment & primary key
        $table->string('nama_paket', 100);
        $table->text('deskripsi')->nullable();
        $table->unsignedInteger('harga'); // cukup seperti ini
        $table->string('foto')->nullable();
        $table->boolean('status')->nullable();
        $table->timestamps();
    });
}



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pakets');
    }
};
