<?php
//fix
//digunakan untuk berinteraksi dengan tabel "transaksi" dalam database
//untuk mengelola sebuah data yang ada pada database, menjadi sangat mudah.
//ORM => teknik yang mengubah suatu table menjadi sebuah object, yang nantinya mudah untuk digunakan. 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Transaksi extends Model
{
    use HasFactory;
    protected $table = 'transaksi'; //model "Transaksi" akan berinteraksi dengan tabel "transaksi" dalam database
    protected $primaryKey = 'transaksi_id'; //mengindikasikan bahwa saat melakukan operasi seperti pencarian berdasarkan kunci utama, Laravel akan menggunakan kolom 'transaksi_id' sebagai acuannya
    protected $fillable = [ //berisi daftar kolom yang diizinkan untuk diisi secara massal (mass assignable) menggunakan metode create atau fill pada model ini
        'user_id',
        'kode_transaksi',
        'expiry',
        'total_harga',
        'biaya_ongkir',
        'biaya_admin',
        'status_admin',
        'status_pembayaran',
        'status_pengiriman'
    ];
    public function getTransaksiAdmin() //digunakan untuk mendapatkan daftar transaksi yang berhubungan dengan keranjang, pelanggan, dan toko
    {
        return DB::table('transaksi')
            ->join('keranjang', 'transaksi.kode_transaksi', '=', 'keranjang.kode_transaksi')
            ->join('users AS cust', 'transaksi.user_id', '=', 'cust.user_id')
            ->join('users AS toko', 'keranjang.toko_id', '=', 'toko.user_id')
            ->select('transaksi.*', 'cust.username AS cust_username', 'toko.username AS toko_username')
            ->get();
    }

    public function getRekapPeternak() //digunakan untuk mendapatkan rekapitulasi transaksi dari peternak
    {
        return DB::table('transaksi')
            ->join('keranjang', 'transaksi.kode_transaksi', '=', 'transaksi.kode_transaksi')
            ->join('users', 'keranjang.cust_id', '=', 'users.user_id')
            ->join('produk', 'keranjang.produk_id', '=', 'produk.produk_id')
            ->where('keranjang.toko_id', auth()->user()->user_id)
            ->select(['transaksi.created_at', 'produk.nama_produk', 'users.username', 'transaksi.total_harga'])
            ->get();
    }

    public function getTransaksiPeternak() //digunakan untuk mendapatkan daftar transaksi yang terkait dengan peternak
    {
        return DB::table('transaksi')
            ->join('keranjang', 'transaksi.kode_transaksi', '=', 'transaksi.kode_transaksi')
            ->join('users', 'keranjang.cust_id', '=', 'users.user_id')
            ->where('keranjang.toko_id', auth()->user()->user_id)
            ->get();
    }

    public function getTransaksiPelanggan() //digunakan untuk mendapatkan daftar transaksi yang terkait dengan pelanggan
    {
        return DB::table('transaksi')
            ->join('keranjang', 'transaksi.kode_transaksi', '=', 'transaksi.kode_transaksi')
            ->join('users', 'keranjang.toko_id', '=', 'users.user_id')
            ->where('keranjang.cust_id', auth()->user()->user_id)
            ->where('status', 'checkout')
            ->get();
    }
}
