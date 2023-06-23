<?php
//fix
//menyimpan keluhan yang diajukan oleh pengguna dalam sistem

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
        Schema::create('keluhan', function (Blueprint $table) {
            $table->id('keluhan_id'); //kolom auto-increment yang akan menjadi primary key tabel
            $table->foreignId('user_id')->constrained('users', 'user_id')->cascadeOnDelete(); //mengindikasikan bahwa jika entitas pengguna terkait dihapus, maka record di tabel keluhan yang terkait juga akan dihapus
            $table->string('question'); //menyimpan pertanyaan atau keluhan yang diajukan oleh pengguna
        });
    }

    /**
     * Reverse the migrations.
     * Setelah migrasi dijalankan, tabel keluhan akan tersedia dalam skema database. Jika migrasi di-rollback, tabel ini akan dihapus dari skema database
     */
    public function down(): void
    {
        Schema::dropIfExists('keluhan');
    }
};
