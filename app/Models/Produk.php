<?php
//fix
//digunakan untuk berinteraksi dengan tabel "produk" dalam database
//untuk mengelola sebuah data yang ada pada database, menjadi sangat mudah.
//ORM => teknik yang mengubah suatu table menjadi sebuah object, yang nantinya mudah untuk digunakan. 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;

class Produk extends Model
{
    use HasFactory;
    protected $primaryKey = 'produk_id'; //mengindikasikan bahwa saat melakukan operasi seperti pencarian berdasarkan kunci utama, Laravel akan menggunakan kolom 'produk_id' sebagai acuannya
    protected $table = 'produk'; //model "Produk" akan berinteraksi dengan tabel "produk" dalam database
    protected $fillable = [ //daftar kolom yang diizinkan untuk diisi secara massal (mass assignable) menggunakan metode create atau fill pada model ini
        'user_id',
        'nama_produk',
        'image_produk',
        'harga',
        'jenis',
        'berat',
        'deskripsi',
        'status'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id'); //menunjukkan bahwa setiap produk dimiliki oleh satu pengguna (user)
    }

    public function getRekapPeternak() //digunakan untuk mendapatkan rekapitulasi transaksi dari peternak
    {
        return DB::table('transaksi')
            ->join('keranjang', 'transaksi.kode_transaksi', '=', 'transaksi.kode_transaksi')
            ->join('users', 'keranjang.cust_id', '=', 'users.user_id')
            ->join('produk', 'keranjang.produk_id', '=', 'produk.produk_id')
            ->where('keranjang.toko_id', auth()->user()->user_id)
            ->select(['produk.nama_produk', 'users.username', 'keranjang.stock'])
            ->get();
    }
}
