<?php
//fix
//menyimpan ulasan atau review terhadap produk

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
        Schema::create('ulasan', function (Blueprint $table) {
            $table->id('ulasan_id'); //kolom auto-increment yang akan menjadi primary key tabel
            $table->foreignId('user_id')->constrained('users', 'user_id')->cascadeOnDelete(); //mengindikasikan bahwa jika entitas pengguna terkait dihapus, maka record di tabel ulasan yang terkait juga akan dihapus
            $table->foreignId('produk_id')->constrained('produk', 'produk_id')->cascadeOnDelete(); //mengindikasikan bahwa jika entitas produk terkait dihapus, maka record di tabel ulasan yang terkait juga akan dihapus
            $table->string('deskripsi'); //menyimpan deskripsi atau isi dari ulasan
            $table->integer('rating'); //menyimpan nilai rating atau penilaian terhadap produk
            $table->timestamps(); //secara otomatis akan mencatat waktu pembuatan dan pembaruan record dalam tabel
        });
    }

    /**
     * Reverse the migrations.
     * Setelah migrasi dijalankan, tabel ulasan akan tersedia dalam skema database. Jika migrasi di-rollback, tabel ini akan dihapus dari skema database
     */
    public function down(): void
    {
        Schema::dropIfExists('ulasan');
    }
};
