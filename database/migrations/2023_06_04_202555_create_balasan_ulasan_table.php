<?php
//fix
//menyimpan balasan terhadap sebuah ulasan

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
        Schema::create('balasan_ulasan', function (Blueprint $table) {
            $table->id('balasan_id'); //kolom auto-increment yang akan menjadi primary key tabel
            $table->foreignId('ulasan_id')->constrained('ulasan', 'ulasan_id')->cascadeOnDelete(); //mengindikasikan bahwa jika entitas ulasan terkait dihapus, maka record di tabel balasan_ulasan yang terkait juga akan dihapus
            $table->string('deskripsi'); //menyimpan deskripsi atau isi dari balasan ulasan
            $table->timestamps(); //secara otomatis akan mencatat waktu pembuatan dan pembaruan record dalam tabel
        });
    }

    /**
     * Reverse the migrations.
     * Setelah migrasi dijalankan, tabel balasan_ulasan akan tersedia dalam skema database. Jika migrasi di-rollback, tabel ini akan dihapus dari skema database.
     */
    public function down(): void
    {
        Schema::dropIfExists('balasan_ulasan');
    }
};
