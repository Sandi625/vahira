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
       Schema::create('customers', function (Blueprint $table) {
    $table->id('id_customer');
    $table->unsignedBigInteger('id_admin');
    $table->string('nama_customer');
    $table->string('alamat_jemput');
    $table->string('alamat_tujuan');
    $table->string('email_customer')->unique();
    $table->string('password');
    $table->timestamps();

    $table->foreign('id_admin')->references('id_admin')->on('admins')->onDelete('cascade');
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
