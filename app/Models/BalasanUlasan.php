<?php
//fix
//digunakan untuk berinteraksi dengan tabel "balasan_ulasan" dalam database
//untuk mengelola sebuah data yang ada pada database, menjadi sangat mudah.
//ORM => teknik yang mengubah suatu table menjadi sebuah object, yang nantinya mudah untuk digunakan. 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BalasanUlasan extends Model
{
    use HasFactory;
    protected $primaryKey = 'balasan_id'; //mengindikasikan bahwa saat melakukan operasi seperti pencarian berdasarkan kunci utama, Laravel akan menggunakan kolom 'balasan_id' sebagai acuannya
    protected $table = 'balasan_ulasan'; //berinteraksi dengan tabel "balasan_ulasan" dalam database
    protected $fillable = [ //daftar kolom yang diizinkan untuk diisi secara massal (mass assignable) menggunakan metode create atau fill
        'ulasan_id',
        'deskripsi'
    ];
}
