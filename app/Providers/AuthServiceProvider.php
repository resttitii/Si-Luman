<?php
//fix
//digunakan untuk mendaftarkan kebijakan (policies) otentikasi dan otorisasi dalam aplikasi Anda

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    
    protected $policies = [ //daftar pemetaan model ke kebijakan (model-to-policy mappings) dalam aplikasi
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void //digunakan untuk menginisialisasi layanan otentikasi dan otorisasi
    {
        //
    }
}
