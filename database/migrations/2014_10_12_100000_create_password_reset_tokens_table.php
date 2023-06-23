<?php
//fix
//menyimpan token reset password dan informasi terkait yang berkaitan dengan proses reset password pengguna

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
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary(); //kolom string dan juga sebagai primary key pada tabel. Ini berarti nilai di kolom email harus unik untuk setiap baris dalam tabel
            $table->string('token'); //kolom string yang akan menyimpan token reset password
            $table->timestamp('created_at')->nullable(); //menyimpan informasi tanggal dan waktu saat token reset password dibuat. Kolom ini ditandai sebagai nullable, yang berarti dapat memiliki nilai null jika diperlukan
        });
    }

    /**
     * Reverse the migrations.
     * Setelah migrasi dijalankan, tabel "password_reset_tokens" akan tersedia dalam skema database. Jika migrasi di-rollback, tabel ini akan dihapus dari skema database
     */
    public function down(): void
    {
        Schema::dropIfExists('password_reset_tokens');
    }
};
