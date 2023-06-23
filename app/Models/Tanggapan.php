<?php
//fix
//digunakan untuk berinteraksi dengan tabel "tanggapan" dalam database
//untuk mengelola sebuah data yang ada pada database, menjadi sangat mudah.
//ORM => teknik yang mengubah suatu table menjadi sebuah object, yang nantinya mudah untuk digunakan. 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tanggapan extends Model
{
    use HasFactory;
    public $timestamps = false; //menentukan bahwa model "Tanggapan" tidak akan menggunakan kolom "created_at" dan "updated_at" untuk menandai waktu pembuatan dan pembaruan
    protected $table = 'tanggapan'; //model "Tanggapan" akan berinteraksi dengan tabel "tanggapan" dalam database
    protected $primaryKey = 'tanggapan_id'; //mengindikasikan bahwa saat melakukan operasi seperti pencarian berdasarkan kunci utama, Laravel akan menggunakan kolom 'tanggapan_id' sebagai acuannya

    protected $fillable = [ //berisi daftar kolom yang diizinkan untuk diisi secara massal (mass assignable) menggunakan metode create atau fill pada model ini
        'user_id',
        'keluhan_id',
        'comment'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); //menunjukkan bahwa setiap tanggapan dimiliki oleh satu pengguna (user)
    }

    public function keluhan()
    {
        return $this->belongsTo(Keluhan::class, 'keluhan_id'); //menunjukkan bahwa setiap tanggapan dimiliki oleh satu keluhan
    }
}
