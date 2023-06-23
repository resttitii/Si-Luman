<?php
//fix
//menyimpan token reset password dan informasi terkait yang digunakan dalam proses reset password pengguna

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('password_resets', function (Blueprint $table) {
            $table->string('email')->index(); //memungkinkan pencarian berdasarkan kolom ini menjadi lebih efisien
            $table->string('token'); // menyimpan token reset password
            $table->timestamp('created_at')->nullable(); //menyimpan informasi tanggal dan waktu saat token reset password dibuat. Kolom ini ditandai sebagai nullable, yang berarti dapat memiliki nilai null jika diperlukan
        });
    }

    /**
     * Reverse the migrations.
     *Setelah migrasi dijalankan, tabel password_resets akan tersedia dalam skema database. Jika migrasi di-rollback, tabel ini akan dihapus dari skema database
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('password_resets');
    }
};
