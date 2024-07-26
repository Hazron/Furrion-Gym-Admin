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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id('id_invoice');
            $table->date('tanggal'); //tanggal ketika ada store/update members
            $table->string('members_id')->nullable(); //berasal dari tabel members
            $table->string('sesi_pt')->nullable();
            $table->string('paket_memeber')->nullable();
            $table->string('nominal');
            $table->string('tipe_invoice'); //update member, regis member, penjualan barang
            $table->string('bukti_pembayaran')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice');
    }
};
