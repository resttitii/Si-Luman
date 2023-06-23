<?php
//fix
//menyimpan tanggapan atau komentar terhadap keluhan yang diajukan dalam sistem

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
        Schema::create('tanggapan', function (Blueprint $table) {
            $table->id('tanggapan_id'); //kolom auto-increment yang akan menjadi primary key tabel
            $table->foreignId('user_id')->constrained('users', 'user_id')->cascadeOnDelete(); //mengindikasikan bahwa jika entitas pengguna terkait dihapus, maka record di tabel tanggapan yang terkait juga akan dihapus
            $table->foreignId('keluhan_id')->constrained('keluhan', 'keluhan_id')->cascadeOnDelete(); //mengindikasikan bahwa jika entitas keluhan terkait dihapus, maka record di tabel tanggapan yang terkait juga akan dihapus
            $table->string('comment'); //menyimpan tanggapan atau komentar terhadap keluhan
        });
    }

    /**
     * Reverse the migrations.
     * Setelah migrasi dijalankan, tabel tanggapan akan tersedia dalam skema database. Jika migrasi di-rollback, tabel ini akan dihapus dari skema database
     */
    public function down(): void
    {
        Schema::dropIfExists('tanggapan');
    }
};
