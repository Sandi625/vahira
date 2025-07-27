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
    Schema::create('bukti_tf', function (Blueprint $table) {
        $table->id();
        $table->foreignId('bank_id')->constrained('banks')->onDelete('cascade');
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // relasi ke user
        $table->string('nama_pengirim');
        $table->unsignedBigInteger('jumlah_transfer');
        $table->string('bukti_transfer'); // path file bukti transfer
        $table->text('catatan')->nullable();
        $table->timestamps();
    });
}



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bukti_tf');
    }
};
