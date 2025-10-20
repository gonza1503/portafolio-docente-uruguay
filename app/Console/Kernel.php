<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

/**
 * Kernel de consola
 *
 * Define los comandos programados y carga comandos personalizados.
 */
class Kernel extends ConsoleKernel
{
    /**
     * Define el calendario de tareas programadas.
     */
    protected function schedule(Schedule $schedule): void
    {
        // Ejemplo: $schedule->command('inspire')->hourly();
    }

    /**
     * Registra los comandos de la aplicación.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');
        require base_path('routes/console.php');
    }
}