<?php
//fix
//menyimpan informasi pengguna dalam sistem

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
        Schema::create('users', function (Blueprint $table) {
            $table->id('user_id'); //kolom dengan tipe data auto-incrementing integer yang akan menjadi primary key tabel
            $table->string('name', 200); //menyimpan nama pengguna
            $table->string('username', 100)->unique(); //nilai yang disimpan dalam kolom username harus bersifat unik di dalam tabel
            $table->string('alamat'); //menyimpan alamat pengguna
            $table->string('email', 100)->unique(); //nilai yang disimpan dalam kolom email harus bersifat unik di dalam tabel
            $table->string('no_hp', 15); //menyimpan nomor telepon pengguna
            $table->string('password'); //menyimpan password pengguna
            $table->enum('role', ['pelanggan', 'peternak', 'dokter', 'admin']); //mendefinisikan kolom role sebagai kolom enum yang akan menyimpan peran (role) pengguna. Nilai yang diperbolehkan adalah 'pelanggan', 'peternak', 'dokter', atau 'admin'
            $table->timestamp('email_verified_at')->nullable(); //pengguna belum melakukan verifikasi email, nilai kolom ini bisa kosong/null
            $table->rememberToken(); //menambahkan kolom remember_token ke tabel. Kolom ini digunakan oleh Laravel untuk menyimpan token yang digunakan dalam otentikasi "remember me"
        });
    }

    /**
     * Reverse the migrations.
     * Setelah migrasi dijalankan, tabel "users" akan tersedia dalam skema database. Jika migrasi di-rollback, tabel ini akan dihapus dari skema database
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
