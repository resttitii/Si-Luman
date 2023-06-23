<?php
//fix
//menyimpan informasi tentang pekerjaan-pekerjaan yang gagal dieksekusi dalam sistem antrian pekerjaan (job queue) Laravel
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
        Schema::create('failed_jobs', function (Blueprint $table) {
            $table->id(); //kolom auto-increment yang akan menjadi primary key tabel
            $table->string('uuid')->unique(); //menyimpan UUID (Universally Unique Identifier) yang akan mengidentifikasi setiap pekerjaan yang gagal
            $table->text('connection'); //menyimpan informasi tentang koneksi atau driver yang digunakan dalam eksekusi pekerjaan
            $table->text('queue'); //menyimpan nama antrian (queue) di mana pekerjaan telah ditambahkan
            $table->longText('payload'); //menyimpan informasi lengkap tentang pekerjaan yang gagal, termasuk kelas, metode, dan parameter yang terkait
            $table->longText('exception'); //menyimpan informasi tentang pengecualian (exception) yang terjadi saat pekerjaan gagal dieksekusi
            $table->timestamp('failed_at')->useCurrent(); //menyimpan informasi tentang waktu ketika pekerjaan gagal terjadi. useCurrent() digunakan untuk mengatur nilai default kolom ini menjadi waktu saat ini
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('failed_jobs');
    }
};
