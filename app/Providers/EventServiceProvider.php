<?php
//fix
//digunakan untuk mengkonfigurasi peristiwa dan pendengar dalam aplikasi

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [ //berisi pemetaan antara peristiwa (event) dengan pendengar (listener) yang akan menanganinya
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void //melakukan konfigurasi awal peristiwa dan pendengar
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool //tidak akan secara otomatis mencari dan mendaftarkan peristiwa dan pendengar
    {
        return false;
    }
}
