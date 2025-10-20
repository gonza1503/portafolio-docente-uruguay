<?php

/*
|--------------------------------------------------------------------------
| Configuración de la aplicación
|--------------------------------------------------------------------------
|
| Este archivo contiene algunas de las configuraciones básicas para una
| instalación de Laravel. Se han reducido al mínimo indispensable para
| habilitar el proyecto Portafolio Docente Uruguay. Ajuste estos valores
| según sea necesario.
|
*/

return [
    'name' => env('APP_NAME', 'Portafolio Docente Uruguay'),
    'env' => env('APP_ENV', 'production'),
    'debug' => (bool) env('APP_DEBUG', false),
    'url' => env('APP_URL', 'http://localhost'),

    // Configuración regional: zona horaria y locales
    'timezone' => 'America/Montevideo',
    'locale' => 'es_UY',
    'fallback_locale' => 'es',

    'providers' => [
        /*
         * Proveedores de servicios de Laravel
         */
        Illuminate\Auth\AuthServiceProvider::class,
        Illuminate\Broadcasting\BroadcastServiceProvider::class,
        Illuminate\Bus\BusServiceProvider::class,
        Illuminate\Cache\CacheServiceProvider::class,
        Illuminate\Database\DatabaseServiceProvider::class,
        Illuminate\Encryption\EncryptionServiceProvider::class,
        Illuminate\Filesystem\FilesystemServiceProvider::class,
        Illuminate\Foundation\Providers\FoundationServiceProvider::class,
        Illuminate\Hashing\HashServiceProvider::class,
        Illuminate\Mail\MailServiceProvider::class,
        Illuminate\Pagination\PaginationServiceProvider::class,
        Illuminate\Pipeline\PipelineServiceProvider::class,
        Illuminate\Queue\QueueServiceProvider::class,
        Illuminate\Session\SessionServiceProvider::class,
        Illuminate\Translation\TranslationServiceProvider::class,
        Illuminate\Validation\ValidationServiceProvider::class,
        Illuminate\View\ViewServiceProvider::class,

        /*
         * Paquetes de terceros
         */
        Spatie\Permission\PermissionServiceProvider::class,
        Barryvdh\DomPDF\ServiceProvider::class,
        Maatwebsite\Excel\ExcelServiceProvider::class,
        Spatie\Activitylog\ActivitylogServiceProvider::class,
        Laravel\Sanctum\SanctumServiceProvider::class,
        Inertia\ServiceProvider::class,
    ],

    'aliases' => [
        'App' => Illuminate\Support\Facades\App::class,
        'Auth' => Illuminate\Support\Facades\Auth::class,
        'DB' => Illuminate\Support\Facades\DB::class,
        'Excel' => Maatwebsite\Excel\Facades\Excel::class,
        'PDF' => Barryvdh\DomPDF\Facade::class,
        'Inertia' => Inertia\Inertia::class,
    ],
];