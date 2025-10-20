<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EvaluacionController;
use App\Http\Controllers\AsistenciaController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Aquí se registran las rutas API para la aplicación. Todas están
| protegidas con Sanctum para autenticación por token.
|
*/

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/grupos/{id}/evaluaciones', [EvaluacionController::class, 'index']);
    Route::get('/asistencias', [AsistenciaController::class, 'index']);
    Route::get('/asistencias/export/pdf', [AsistenciaController::class, 'exportPdf']);
    Route::get('/asistencias/export/excel', [AsistenciaController::class, 'exportExcel']);
    // Endpoints para boletines (PDF)
});