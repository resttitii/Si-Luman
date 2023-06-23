<?php
//fix
//route => penghubung antara user dengan keselutuhan framework
//web.php => routing di web => akses halaman di web browser

use App\Http\Controllers\AppController as App; //AppController => http
use Illuminate\Support\Facades\Auth; //illuminate => namespace => autentikasi
use Illuminate\Support\Facades\Route;//facades => class bantu => route

Auth::routes(['verify' => true]);

//Route::<jenis method>(<alamat URL>,<proses yang dijalankan>)
Route::get('/', [App::class, 'beranda'])->name('beranda');

////konsultasi
Route::prefix('/konsultasi')->group(function () {
    Route::get('/', [App::class, 'konsultasi'])->name('konsultasi');
    Route::get('/ditanggapi', [App::class, 'ditanggapi'])->name('ditanggapi');
    Route::get('/belum_ditanggapi', [App::class, 'belum_ditanggapi'])->name('belum_ditanggapi');
});

//toko
Route::get('/toko', [App::class, 'toko'])->name('toko');

//http => middleware => cek hak akses user => penengah antara controller dan route => authentikasi
//Middleware ini digunakan untuk memvalidasi dan membatasi akses berdasarkan autentikasi pengguna serta peran pengguna yang terdaftar dalam aplikasi
Route::middleware('auth')->group(function () {
    Route::middleware('verified')->group(function () { //cek apakah role sudah verified atau belum => karena untuk role pelanggan bisa saja belum verified
        
        //hak akses keluhan hanya untuk peternak dan pelanggan
        Route::middleware('cekrole:peternak,pelanggan')->group(function () {
            Route::get('/tambah_keluhan', [App::class, 'tambah_keluhan'])->name('tambah_keluhan');
            Route::post('/buat_keluhan', [App::class, 'buat_keluhan']);
            Route::post('/hapus_keluhan/{keluhan_id}', [App::class, 'hapus_keluhan']);
            Route::get('/konsultasi_lanjutan', [App::class, 'konsultasi_lanjutan'])->name('konsultasi_lanjutan');
        });
    });

    //tanggapan
    Route::get('/tanggapan/{keluhan_id}', [App::class, 'tanggapan']);

    //hak akses tanggapan hanya untuk dokter, peternak, dan pelanggan
    Route::middleware('cekrole:dokter,pelanggan,peternak')->group(function () {
        Route::get('/tambah_tanggapan/{keluhan_id}', [App::class, 'tambah_tanggapan']);
        Route::post('/buat_tanggapan', [App::class, 'buat_tanggapan']);
        Route::post('/hapus_tanggapan/{tanggapan_id}', [App::class, 'hapus_tanggapan']);
    });

    //hak akses transaksi semua role kecuali dokter
    Route::middleware('cekrole:admin,peternak,pelanggan')->group(function () {
        Route::get('/transaksi', [App::class, 'transaksi'])->name('transaksi');
    });

    //hak akses untuk pelanggan
    Route::middleware('cekrole:pelanggan')->group(function () {
        Route::get('/upgrade_role', [App::class, 'upgrade_role'])->name('upgrade_role');
        Route::get('/keranjang', [App::class, 'keranjang'])->name('keranjang');
        Route::get('/kontak_peternak/{user_id}', [App::class, 'kontak_peternak']);
        Route::post('/create_keranjang', [App::class, 'create_keranjang']);
        Route::post('/hapus_keranjang', [App::class, 'hapus_keranjang']);
        Route::post('/create_checkout', [App::class, 'create_checkout']);
        Route::get('/checkout/{kode_transaksi}', [App::class, 'checkout']);
        Route::post('/update_checkout/{kode_transaksi}', [App::class, 'update_checkout']);
        Route::get('/form_bayar/{kode_transaksi}', [App::class, 'form_bayar']);
        Route::get('/ulasan/{produk_id}', [App::class, 'ulasan']);
        Route::post('/create_ulasan', [App::class, 'create_ulasan']);
        Route::post('/hapus_ulasan/{ulasan_id}', [App::class, 'hapus_ulasan']);
    });

    //profile
    Route::get('/profile', [App::class, 'profile'])->name('profile');

    //hak akses edit profile semua aktor kecuali admin
    Route::middleware('cekrole:pelanggan,peternak,dokter')->group(function () {
        Route::get('/edit_profile/{user_id}', [App::class, 'edit_profile']);
        Route::post('/update_profile/{user_id}', [App::class, 'update_profile']);
    });

    //hak akses edit tanggapan cuma dokter
    Route::middleware('cekrole:dokter')->group(function () {
        Route::get('/edit_tanggapan/{tanggapan_id}/{keluhan_id}', [App::class, 'edit_tanggapan']);
        Route::post('/update_tanggapan/{tanggapan_id}', [App::class, 'update_tanggapan']);
    });

    //hak akses admin
    Route::middleware('cekrole:admin')->group(function () {
        Route::get('/data_pelanggan', [App::class, 'data_pelanggan'])->name('data_pelanggan');
        Route::get('/data_peternak', [App::class, 'data_peternak'])->name('data_peternak');
        Route::get('/data_dokter', [App::class, 'data_dokter'])->name('data_dokter');
        Route::get('/change_role', [App::class, 'change_role'])->name('change_role');
        Route::post('/change_role/{user_id}', [App::class, 'update_role']);
        Route::post('/hapus_user/{user_id}', [App::class, 'hapus_user']);
        Route::post('/update_statusAdmin/{kode_transaksi}', [App::class, 'update_statusAdmin']);
    });

    //hak akses peternak
    Route::middleware('cekrole:peternak')->group(function () {
        Route::get('/produk', [App::class, 'produk'])->name('produk');
        Route::get('/create_produk', [App::class, 'create_produk'])->name('create_produk');
        Route::post('/handleCreateProduk', [App::class, 'handleCreateProduk'])->name('handleCreateProduk');
        Route::get('/edit_produk/{produk_id}', [App::class, 'edit_produk']);
        Route::post('/update_produk/{produk_id}', [App::class, 'update_produk']);
        Route::post('/hapus_produk/{produk_id}', [App::class, 'hapus_produk']);
        Route::post('/update_statusPembayaran/{kode_transaksi}/{toko_id}', [App::class, 'update_statusPembayaran']);
        Route::post('/update_statusPengiriman/{kode_transaksi}/{toko_id}', [App::class, 'update_statusPengiriman']);
        Route::get('/balas_ulasan/{ulasan_id}', [App::class, 'balas_ulasan']);
        Route::post('/create_balas_ulasan', [App::class, 'create_balas_ulasan']);
        Route::get('/edit_balas_ulasan/{ulasan_id}/{balasan_id}', [App::class, 'edit_balas_ulasan']);
        Route::post('/update_balas_ulasan/{balasan_id}', [App::class, 'update_balas_ulasan']);
        Route::post('/hapus_balas_ulasan/{balasan_id}', [App::class, 'hapus_balas_ulasan']);
        Route::get('/rekap_transaksi', [App::class, 'rekap_transaksi'])->name('rekap_transaksi');
        Route::get('/rekap_penilaian/{produk_id}', [App::class, 'rekap_penilaian']);
        Route::get('/rekap-produk', [App::class, 'rekap_produk'])->name('rekap_produk');
    });

    //toko
    Route::get('/detail_produk/{produk_id}', [App::class, 'detail_produk']);
    Route::get('/detail_toko/{user_id}', [App::class, 'detail_toko']);
});

Route::middleware('cekrole:pelanggan,peternak')->group(function () {
    Route::get('/detail_transaksi/{kode_transaksi}', [App::class, 'detail_transaksi']);
});