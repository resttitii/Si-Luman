<?php
//fix
//digunakan untuk berinteraksi dengan tabel "user" dalam database
//untuk mengelola sebuah data yang ada pada database, menjadi sangat mudah.
//ORM => teknik yang mengubah suatu table menjadi sebuah object, yang nantinya mudah untuk digunakan. 

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    public $timestamps = false; //menunjukkan bahwa model "User" tidak memiliki kolom "created_at" dan "updated_at"
    protected $primaryKey = 'user_id'; //mengindikasikan bahwa saat melakukan operasi seperti pencarian berdasarkan kunci utama, Laravel akan menggunakan kolom 'user_id' sebagai acuannya
    protected $fillable = [ //berisi daftar kolom yang diizinkan untuk diisi secara massal (mass assignable) menggunakan metode create atau fill pada model ini
        'name',
        'username',
        'email',
        'password',
        'role',
        'alamat',
        'no_hp'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [ //berisi daftar kolom yang harus disembunyikan saat objek model di-serialisasi
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [ //menentukan tipe data yang harus diterjemahkan oleh Eloquent. Dalam contoh ini, kolom 'email_verified_at' akan diterjemahkan sebagai tipe data 'datetime', yang memungkinkan Laravel untuk memperlakukan kolom tersebut sebagai objek DateTime
        'email_verified_at' => 'datetime',
    ];
}
