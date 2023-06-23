<?php
//fix
//untuk mendaftarkan dan menginisialisasi layanan aplikasi

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void //digunakan untuk mendaftarkan layanan aplikasi
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void //digunakan untuk menginisialisasi layanan aplikasi
    {
        //
    }
}
