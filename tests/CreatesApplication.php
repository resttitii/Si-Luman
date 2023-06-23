<?php
//fix
//untuk membuat instance aplikasi Laravel

namespace Tests;

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Application;

trait CreatesApplication
{
    /**
     * Creates the application.
     */
    public function createApplication(): Application
    {
        //Mengimpor dan menjalankan file bootstrap/app.php yang merupakan file awal dalam aplikasi Laravel
        $app = require __DIR__.'/../bootstrap/app.php';

        //bertanggung jawab untuk bootstrapping dan menangani permintaan aplikasi
        $app->make(Kernel::class)->bootstrap();

        //Mengembalikan instance aplikasi Laravel yang telah dibuat
        return $app;
    }
}
