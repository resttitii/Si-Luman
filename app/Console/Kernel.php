<?php
//fix
//digunakan untuk mengatur jadwal perintah serta mendaftarkan perintah-perintah aplikasi

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void //untuk mendefinisikan jadwal perintah aplikasi
    {
        // $schedule->command('inspire')->hourly();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void //untuk mendaftarkan perintah-perintah aplikasi.
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
