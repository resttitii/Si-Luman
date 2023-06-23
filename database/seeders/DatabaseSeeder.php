<?php
//fix
//untuk menghasilkan data dummy yang dapat digunakan dalam pengembangan, pengujian, atau demonstrasi aplikasi
//gunakan perintah php artisan db:seed untuk mengisi data dummy ke dalam database

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //Data dummy adalah data palsu atau data contoh yang digunakan untuk tujuan pengembangan, pengujian, atau demonstrasi.

        //seeding default/dummy ongkir => berisi alamat dan harga ongkir untuk beberapa daerah.
        DB::table('ongkir_domisili')->insert([
            [
                'alamat'    => 'Banyuwangi',
                'harga'     => 100000
            ],
            [
                'alamat'    => 'Jember',
                'harga'     => 120000
            ],
            [
                'alamat'    => 'Situbondo',
                'harga'     => 140000
            ],
            [
                'alamat'    => 'Bondowoso',
                'harga'     => 160000
            ],
            [
                'alamat'    => 'Besuki',
                'harga'     => 180000
            ],
        ]);


        //seeding default/dummy user => informasi pengguna seperti nama, username, password, alamat, email, nomor telepon, dan peran (role).
        //password (terenkripsi menggunakan Hash::make)
        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'username' => 'siluman01',
                'password' => Hash::make('admin123'),
                'alamat' => '-',
                'email' => 'admin@gmail.com',
                'email_verified_at' => now(),
                'no_hp' => '+6283373914639',
                'role' => 'admin'
            ],
            [
                'name' => 'Henry Kurniawan',
                'username' => 'HenryKurniawan',
                'password' => Hash::make('dokter123'),
                'alamat' => 'Jl. Tawang Mangu, Tlogo Wetan, Antirogo, Kec. Sumbersari, Kabupaten Jember, Jawa Timur 68124',
                'email' => 'henrykurniawan@gmail.com',
                'email_verified_at' => now(),
                'no_hp' => '+6285236156270',
                'role' => 'dokter'
            ],
            [
                'name' => 'Sutrisno',
                'username' => 'SutrisnoFarm',
                'password' => Hash::make('peternak123'),
                'alamat' => 'di Jalan Kenanga, Dusun Polean , Desa Tamansari, Kecamatan Tegalsari, Kabupaten Banyuwangi, Jawa Timur 68485',
                'email' => 'sutrisno@gmail.com',
                'email_verified_at' => now(),
                'no_hp' => '+6282136616987',
                'role' => 'peternak'
            ],
            [
                'name' => 'Gojo Satoru',
                'username' => 'gojoganteng',
                'password' => Hash::make('gojo12345'),
                'alamat' => 'Jalan Mastrip no 10',
                'email' => 'gojosatoru@gmail.com',
                'email_verified_at' => now(),
                'no_hp' => '+6285700510840',
                'role' => 'pelanggan'
            ],
        ]);


        //seeding default/dummy product => informasi produk seperti id pengguna, nama produk, gambar produk, harga, jenis produk, berat, deskripsi, dan status ketersediaan produk
        DB::table('produk')->insert([
            [
                'user_id'       => 3,
                'nama_produk'   => 'Kambing Jawa',
                'image_produk'  => 'kambing.png',
                'harga'         => 2000000,
                'jenis'         => 'hewan',
                'berat'         => 25,
                'deskripsi'     => 'ini kambing betina',
                'status'        => 'tersedia'
            ],
            [
                'user_id'       => 3,
                'nama_produk'   => 'Ayam Jago',
                'image_produk'  => 'ayam.png',
                'harga'         => 200000,
                'jenis'         => 'hewan',
                'berat'         => 2,
                'deskripsi'     => 'ini ayam bagus',
                'status'        => 'tersedia'
            ],
        ]);
    }
}
