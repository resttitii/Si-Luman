<?php
//fix
//digunakan untuk berinteraksi dengan tabel "ongkir_domisili" dalam database
//untuk mengelola sebuah data yang ada pada database, menjadi sangat mudah.
//ORM => teknik yang mengubah suatu table menjadi sebuah object, yang nantinya mudah untuk digunakan. 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OngkirDomisili extends Model
{
    use HasFactory;
    protected $primaryKey = 'ongkir_id'; //mengindikasikan bahwa saat melakukan operasi seperti pencarian berdasarkan kunci utama, Laravel akan menggunakan kolom 'ongkir_id' sebagai acuannya
    protected $table = 'ongkir_domisili'; //model "OngkirDomisili" akan berinteraksi dengan tabel "ongkir_domisili" dalam database
    protected $fillable = [ //daftar kolom yang diizinkan untuk diisi secara massal (mass assignable) menggunakan metode create atau fill pada model ini
        'alamat',
        'harga'
    ];
}
