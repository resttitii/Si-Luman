<?php
//fix
//menyimpan informasi tentang keranjang belanja

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
        Schema::create('keranjang', function (Blueprint $table) {
            $table->id('keranjang_id'); //kolom auto-increment yang akan menjadi primary key tabel
            $table->string('kode_transaksi')->nullable(); //menyimpan kode transaksi yang terkait dengan keranjang
            $table->foreignId('toko_id')->constrained('users', 'user_id')->cascadeOnDelete(); //mengindikasikan bahwa jika entitas toko terkait dihapus, maka record di tabel keranjang yang terkait juga akan dihapus
            $table->foreignId('produk_id')->constrained('produk', 'produk_id')->cascadeOnDelete(); //mengindikasikan bahwa jika entitas produk terkait dihapus, maka record di tabel keranjang yang terkait juga akan dihapus
            $table->foreignId('cust_id')->constrained('users', 'user_id'); //mendefinisikan kolom cust_id sebagai foreign key yang akan terhubung dengan kolom user_id pada tabel users
            $table->integer('stock')->nullable(); //menyimpan jumlah stok produk dalam keranjang
            $table->enum('status', ['keranjang', 'checkout'])->default('keranjang'); //menyimpan status keranjang, dengan nilai default 'keranjang'
            $table->timestamps();  //secara otomatis akan mencatat waktu pembuatan dan pembaruan record dalam tabel
        });
    }

    /**
     * Reverse the migrations.
     * Setelah migrasi dijalankan, tabel keranjang akan tersedia dalam skema database. Jika migrasi di-rollback, tabel ini akan dihapus dari skema database
     */
    public function down(): void
    {
        Schema::dropIfExists('keranjang');
    }
};
