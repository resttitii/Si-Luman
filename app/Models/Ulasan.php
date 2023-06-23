<?php
//fix
//digunakan untuk berinteraksi dengan tabel "ulasan" dalam database
//untuk mengelola sebuah data yang ada pada database, menjadi sangat mudah.
//ORM => teknik yang mengubah suatu table menjadi sebuah object, yang nantinya mudah untuk digunakan. 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ulasan extends Model
{
    use HasFactory;
    protected $table = 'ulasan'; //model "Ulasan" akan berinteraksi dengan tabel "ulasan" dalam database
    protected $primaryKey = 'ulasan_id'; //mengindikasikan bahwa saat melakukan operasi seperti pencarian berdasarkan kunci utama, Laravel akan menggunakan kolom 'ulasan_id' sebagai acuannya
    protected $fillable = [ //berisi daftar kolom yang diizinkan untuk diisi secara massal (mass assignable) menggunakan metode create atau fill pada model ini
        'user_id',
        'produk_id',
        'deskripsi',
        'rating',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id'); //menunjukkan bahwa setiap ulasan dimiliki oleh satu pengguna (user)
    }

    public function produk(): BelongsTo
    {
        return $this->belongsTo(Produk::class, 'produk_id'); //menunjukkan bahwa setiap ulasan dimiliki oleh satu produk
    }
}
