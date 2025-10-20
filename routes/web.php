<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CentroController;
use App\Http\Controllers\GrupoController;
use App\Http\Controllers\EvaluacionController;
use App\Http\Controllers\PlanificacionController;
use App\Http\Controllers\AsistenciaController;
use App\Http\Controllers\ReunionController;
use App\Http\Controllers\ReportController;

/*
|--------------------------------------------------------------------------
| Rutas web
|--------------------------------------------------------------------------
|
| Aquí se registran las rutas web para su aplicación. Estas rutas son
| cargadas por el RouteServiceProvider dentro de un grupo que
| contiene el middleware "web". ¡Disfruta construyendo!
|
*/

Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Rutas protegidas por autenticación
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Rutas exclusivas para directores
    Route::middleware(['role:Director'])->group(function () {
        Route::resource('centros', CentroController::class);
        Route::resource('grupos', GrupoController::class);
        Route::resource('evaluaciones', EvaluacionController::class);
        Route::resource('planificaciones', PlanificacionController::class);
        Route::resource('asistencias', AsistenciaController::class);
        Route::resource('reuniones', ReunionController::class);
        Route::get('reportes', [ReportController::class, 'index'])->name('reportes.index');
    });

    // Rutas exclusivas para docentes
    Route::middleware(['role:Docente'])->group(function () {
        Route::get('/mis-grupos', [GrupoController::class, 'misGrupos'])->name('grupos.mis');
        Route::resource('planificaciones', PlanificacionController::class)->except(['destroy']);
        Route::resource('asistencias', AsistenciaController::class)->only(['index', 'store']);
        Route::resource('evaluaciones', EvaluacionController::class)->only(['index', 'store']);
        Route::resource('reuniones', ReunionController::class)->only(['index', 'show']);
    });
});

// Aquí se podrían incluir rutas de autenticación (login, registro, password reset)
// Utilice el paquete que prefiera (por ejemplo Breeze) para generar las vistas de autenticación.