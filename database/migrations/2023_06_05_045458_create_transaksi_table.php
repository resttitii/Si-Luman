<?php
//fix
//menyimpan informasi tentang transaksi dalam sistem
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
            $table->id('transaksi_id'); //kolom auto-increment yang akan menjadi primary key tabel
            $table->foreignId('user_id')->constrained('users', 'user_id')->cascadeOnDelete(); //jika record pengguna terkait dihapus, maka juga akan menghapus record transaksi yang terkait
            $table->string('kode_transaksi'); //menyimpan kode transaksi
            $table->dateTime('expiry')->nullable(); //menyimpan waktu kedaluwarsa transaksi. Nilainya dapat bernilai null
            $table->bigInteger('total_harga'); //menyimpan total harga transaksi
            $table->bigInteger('biaya_ongkir')->nullable(); //menyimpan biaya ongkir transaksi. Nilainya dapat bernilai null
            $table->bigInteger('biaya_admin'); //menyimpan biaya admin transaksi
            $table->string('status_admin'); //menyimpan status transaksi dari sisi admin
            $table->string('status_pembayaran'); //menyimpan status pembayaran transaksi
            $table->string('status_pengiriman'); //menyimpan status pengiriman transaksi
            $table->timestamps(); //secara otomatis akan mencatat waktu pembuatan dan pembaruan record dalam tabel
        });
    }

    /**
     * Reverse the migrations.
     * Setelah migrasi dijalankan, tabel transaksi akan tersedia dalam skema database. Jika migrasi di-rollback, tabel ini akan dihapus dari skema database
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
