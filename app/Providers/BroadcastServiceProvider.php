<?php
//fix
//digunakan untuk mengkonfigurasi layanan penyiaran (broadcasting) dalam aplikasi

namespace App\Providers;

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\ServiceProvider;

class BroadcastServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Broadcast::routes(); //digunakan untuk mengatur rute-rute penyiaran (broadcasting routes) dalam aplikasi

        require base_path('routes/channels.php'); //digunakan untuk mendefinisikan saluran-saluran (channels) dan peta saluran (channel mappings) untuk penyiaran dalam aplikasi
    }
}
