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
            $table->id('id_members');
            $table->string('nama');
            $table->string('jenis_kelamin');
            $table->string('paket_id'); //berdasarkan table pakets
            $table->date('tanggal_daftar'); //now
            $table->date('tanggal_selesai'); // hitungan berdasarkan durasi pada tabel pakets PERBULAN
            $table->date('tanggal_perbarui')->nullable(); //tanggal kapan dia perbaharui. 
            $table->string('status')->default('aktif');
            $table->string('no_telpon');
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
