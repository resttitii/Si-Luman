<?php
//fix
//menyimpan informasi tentang ongkir berdasarkan domisili atau alamat

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
        Schema::create('ongkir_domisili', function (Blueprint $table) {
            $table->id('ongkir_id'); //kolom auto-increment yang akan menjadi primary key tabel
            $table->string('alamat'); //menyimpan alamat domisili
            $table->bigInteger('harga'); //menyimpan harga ongkir
            $table->timestamps(); //secara otomatis akan mencatat waktu pembuatan dan pembaruan record dalam tabel
        });
    }

    /**
     * Reverse the migrations.
     * Setelah migrasi dijalankan, tabel ongkir_domisili akan tersedia dalam skema database. Jika migrasi di-rollback, tabel ini akan dihapus dari skema database
     */
    public function down(): void
    {
        Schema::dropIfExists('ongkir_domisili');
    }
};
