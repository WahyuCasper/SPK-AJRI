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
        Schema::create('data_users', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->integer('pendapatan');
            $table->integer('kepemilikan_aset');
            $table->integer('jumlah_tanggungan');
            $table->string('terdaftar_dkts');
            $table->timestamps();
    });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_users');
    }
};
