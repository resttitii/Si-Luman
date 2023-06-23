<?php
//fix

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| The first thing we will do is create a new Laravel application instance
| which serves as the "glue" for all the components of Laravel, and is
| the IoC container for the system binding all of the various parts.
|
*/

//menentukan jalur dasar aplikasi Laravel. Jika tidak ada nilai yang diberikan melalui variabel lingkungan ($_ENV), maka jalur dasar akan diambil dari direktori induk dari direktori saat ini
$app = new Illuminate\Foundation\Application(
    $_ENV['APP_BASE_PATH'] ?? dirname(__DIR__)
);

/*
|--------------------------------------------------------------------------
| Bind Important Interfaces
|--------------------------------------------------------------------------
|
| Next, we need to bind some important interfaces into the container so
| we will be able to resolve them when needed. The kernels serve the
| incoming requests to this application from both the web and CLI.
|
*/

//mengikat implementasi antarmuka penting ke dalam wadah IoC
$app->singleton(
    Illuminate\Contracts\Http\Kernel::class, //kernel HTTP yang menangani permintaan masuk ke aplikasi melalui web
    App\Http\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class, //kernel CLI yang menangani perintah yang dijalankan melalui baris perintah (command line interface)
    App\Console\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class, //penanganan kesalahan dan pengecualian yang terjadi selama eksekusi aplikasi
    App\Exceptions\Handler::class
);

/*
|--------------------------------------------------------------------------
| Return The Application
|--------------------------------------------------------------------------
|
| This script returns the application instance. The instance is given to
| the calling script so we can separate the building of the instances
| from the actual running of the application and sending responses.
|
*/

return $app;
