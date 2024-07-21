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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('email');
            $table->string('paket_id');
            $table->date('tanggal_daftar');
            $table->date('tanggal_selesai');
            $table->date('tanggal_perbarui')->nullable();
            $table->string('status');
            $table->string('no_telpon');
            $table->string('qr_code');
            $table->string('kartu_member')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
