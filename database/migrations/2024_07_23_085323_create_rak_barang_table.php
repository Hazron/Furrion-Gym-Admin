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
        Schema::create('rak_barangs', function (Blueprint $table) {
            $table->string('id_barang')->primary(); // UUID seperti BRG001
            $table->string('nama_barang');
            $table->integer('qty'); // jumlah barang
            $table->integer('harga'); // harga satuan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rak_barang');
    }
};
