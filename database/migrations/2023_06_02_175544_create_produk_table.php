<?php
//fix
// menyimpan informasi mengenai produk yang tersedia dalam sistem

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
        Schema::create('produk', function (Blueprint $table) {
            $table->id('produk_id'); //kolom auto-increment yang akan menjadi primary key tabel
            $table->foreignId('user_id')->constrained('users', 'user_id')->cascadeOnDelete(); //mengindikasikan bahwa jika entitas pengguna terkait dihapus, maka record di tabel produk yang terkait juga akan dihapus
            $table->string('nama_produk'); //menyimpan nama produk
            $table->string('image_produk'); //menyimpan nama file gambar yang mewakili produk
            $table->bigInteger('harga'); //menyimpan harga produk
            $table->enum('jenis', ['hewan', 'pupuk']); //menyimpan jenis produk, dengan opsi nilai yang dapat dipilih adalah 'hewan' atau 'pupuk'
            $table->integer('berat'); //menyimpan berat produk
            $table->text('deskripsi'); //menyimpan deskripsi atau informasi tambahan mengenai produk
            $table->enum('status', ['tersedia', 'kosong']); //menyimpan status ketersediaan produk, dengan opsi nilai yang dapat dipilih adalah 'tersedia' atau 'kosong'
            $table->timestamps(); //secara otomatis akan mencatat waktu pembuatan dan pembaruan record dalam tabel
        });
    }

    /**
     * Reverse the migrations.
     * Setelah migrasi dijalankan, tabel produk akan tersedia dalam skema database. Jika migrasi di-rollback, tabel ini akan dihapus dari skema database.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk');
    }
};
