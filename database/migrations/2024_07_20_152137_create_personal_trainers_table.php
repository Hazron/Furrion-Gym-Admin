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
        Schema::create('personal_trainers', function (Blueprint $table) {
            $table->id('id_pt');
            $table->string('nama');
            $table->string('sesi');
            $table->string('personal_trainer');
            $table->string('status');
            $table->string('maksimal_visit');
            $table->string('visit')->nullable(); //jumlah yang sudah visit
            $table->string('tanggal_mulai');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pt');
    }
};
