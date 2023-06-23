<?php
//fix
//digunakan untuk berinteraksi dengan tabel "keluhan" dalam database
//untuk mengelola sebuah data yang ada pada database, menjadi sangat mudah.
//ORM => teknik yang mengubah suatu table menjadi sebuah object, yang nantinya mudah untuk digunakan. 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keluhan extends Model
{
    use HasFactory;
    public $timestamps = false; //menonaktifkan kolom "created_at" dan "updated_at" pada model ini
    protected $table = 'keluhan'; //model "Keluhan" akan berinteraksi dengan tabel "keluhan" dalam database
    protected $primaryKey = 'keluhan_id'; //mengindikasikan bahwa saat melakukan operasi seperti pencarian berdasarkan kunci utama, Laravel akan menggunakan kolom 'keluhan_id' sebagai acuannya

    protected $fillable = [ //berisi daftar kolom yang diizinkan untuk diisi secara massal (mass assignable) menggunakan metode create atau fill pada model ini
        'user_id',
        'question'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); //bahwa setiap keluhan dimiliki oleh satu pengguna (user)
    }

    public function tanggapan()
    {
        return $this->hasMany(Tanggapan::class, 'keluhan_id'); //menunjukkan bahwa setiap keluhan dapat memiliki banyak tanggapan
    }
}
