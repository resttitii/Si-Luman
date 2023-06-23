<?php
//fix
//mengatur penanganan pengecualian dalam aplikasi

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [ //aftar tipe pengecualian dengan level log khusus yang sesuai
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [ //daftar tipe pengecualian yang tidak akan dilaporkan
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [ //daftar input yang tidak akan ditampilkan dalam sesi saat terjadi pengecualian validasi
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void //digunakan untuk mendaftarkan callback penanganan pengecualian untuk aplikasi
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
}
