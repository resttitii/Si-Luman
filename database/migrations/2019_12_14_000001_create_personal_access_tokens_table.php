<?php
//fix
//menyimpan informasi tentang personal access tokens yang digunakan dalam mekanisme autentikasi API di Laravel

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
        Schema::create('personal_access_tokens', function (Blueprint $table) {
            $table->id(); //kolom id sebagai kolom auto-increment yang akan menjadi primary key tabel
            $table->morphs('tokenable'); //digunakan untuk mengidentifikasi model yang memiliki personal access token
            $table->string('name'); //enyimpan nama personal access token
            $table->string('token', 64)->unique(); //menyimpan token personal access yang bersifat unik
            $table->text('abilities')->nullable(); //menyimpan informasi tentang kemampuan (abilities) yang dimiliki oleh personal access token
            $table->timestamp('last_used_at')->nullable(); //menyimpan informasi tentang waktu terakhir personal access token digunakan. Nilainya dapat bernilai null
            $table->timestamp('expires_at')->nullable(); //menyimpan informasi tentang waktu kedaluwarsa personal access token. Nilainya dapat bernilai null
            $table->timestamps(); //dua kolom timestamp created_at dan updated_at yang secara otomatis akan mencatat waktu pembuatan dan pembaruan record dalam tabel
        });
    }

    /**
     * Reverse the migrations.
     * Setelah migrasi dijalankan, tabel personal_access_tokens akan tersedia dalam skema database. Jika migrasi di-rollback, tabel ini akan dihapus dari skema database
     */
    public function down(): void
    {
        Schema::dropIfExists('personal_access_tokens');
    }
};
