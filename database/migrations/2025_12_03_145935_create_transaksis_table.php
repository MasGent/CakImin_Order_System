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
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pemesan');
            $table->string('kode_pesanan');
            $table->integer('total_harga');
            $table->enum('metode_pembayaran', ['cash', 'transfer']);
            $table->enum('status', ['pending', 'diproses', 'selesai']);
            $table->string('catatan')->nullable();
            $table->unsignedBigInteger('user_id')->nullable(); // kasir
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
