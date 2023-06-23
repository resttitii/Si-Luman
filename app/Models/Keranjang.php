<?php
//fix
//digunakan untuk berinteraksi dengan tabel "keranjang" dalam database
//untuk mengelola sebuah data yang ada pada database, menjadi sangat mudah.
//ORM => teknik yang mengubah suatu table menjadi sebuah object, yang nantinya mudah untuk digunakan. 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Keranjang extends Model
{
    use HasFactory;
    protected $table = 'keranjang'; //model "Keranjang" akan berinteraksi dengan tabel "keranjang" dalam database
    protected $primaryKey = 'keranjang_id'; //mengindikasikan bahwa saat melakukan operasi seperti pencarian berdasarkan kunci utama, Laravel akan menggunakan kolom 'keranjang_id' sebagai acuannya
    protected $fillable = [ //berisi daftar kolom yang diizinkan untuk diisi secara massal (mass assignable) menggunakan metode create atau fill pada model ini
        'toko_id',
        'kode_transaksi',
        'produk_id',
        'cust_id',
        'stock',
        'status'
    ];

    public function produk(): BelongsTo
    {
        return $this->belongsTo(Produk::class, 'produk_id'); //menunjukkan bahwa setiap keranjang terkait dengan satu produk
    }

    public function toko(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id'); //menunjukkan bahwa setiap keranjang terkait dengan satu toko
    }
}
