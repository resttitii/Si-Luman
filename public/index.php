<?php
//fix

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

//mendefinisikan konstanta LARAVEL_START dengan nilai waktu saat ini menggunakan fungsi microtime(true). Konstanta ini digunakan untuk menghitung waktu eksekusi aplikasi
define('LARAVEL_START', microtime(true));

/*
|--------------------------------------------------------------------------
| Check If The Application Is Under Maintenance
|--------------------------------------------------------------------------
|
| If the application is in maintenance / demo mode via the "down" command
| we will load this file so that any pre-rendered content can be shown
| instead of starting the framework, which could cause an exception.
|
*/

//digunakan untuk menampilkan konten yang telah dipre-rendered saat aplikasi sedang dalam mode maintenance atau demo
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| this application. We just need to utilize it! We'll simply require it
| into the script here so we don't need to manually load our classes.
|
*/

// untuk memuat kelas-kelas yang diperlukan oleh aplikasi
require __DIR__.'/../vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
|
| Once we have the application, we can handle the incoming request using
| the application's HTTP kernel. Then, we will send the response back
| to this client's browser, allowing them to enjoy our application.
|
*/

// inisialisasi aplikasi dan pengaturan awal
$app = require_once __DIR__.'/../bootstrap/app.php';

//untuk menangani permintaan HTTP yang masuk dan menghasilkan respons
$kernel = $app->make(Kernel::class);

//mengembalikan respons yang akan dikirimkan kembali ke browser
$response = $kernel->handle(
    $request = Request::capture()
)->send();

// membersihkan sumber daya yang digunakan oleh permintaan dan melakukan tindakan terakhir sebelum menutup permintaan
$kernel->terminate($request, $response);
