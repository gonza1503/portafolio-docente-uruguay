<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\{Grupo,Evaluacion};

/**
 * Controlador Reportes
 *
 * Genera reportes estadísticos para el director.
 */
class ReportController extends Controller
{
    /**
     * Muestra el panel de reportes.
     */
    public function index()
    {
        // Promedios por grupo y materia
        $grupos = Grupo::with('evaluaciones', 'docentes')->get()->map(function ($grupo) {
            $promedios = [];
            foreach ($grupo->docentes as $docente) {
                $notas = $grupo->evaluaciones()->where('docente_id', $docente->id)->pluck('nota');
                $promedios[] = [
                    'docente' => $docente->name,
                    'materia' => $docente->pivot->materia ?? '',
                    'promedio' => $notas->count() ? round($notas->avg(), 2) : null,
                ];
            }
            return [
                'grupo' => $grupo->nombre,
                'promedios' => $promedios,
            ];
        });
        return Inertia::render('Reportes/Index', [
            'grupos' => $grupos,
        ]);
    }
}