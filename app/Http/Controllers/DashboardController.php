<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\{Grupo,Evaluacion,Reunion};
use Illuminate\Support\Facades\Auth;

/**
 * Controlador del Dashboard
 *
 * Muestra información resumida al usuario dependiendo de su rol (director o docente).
 */
class DashboardController extends Controller
{
    /**
     * Muestra el dashboard correspondiente al usuario autenticado.
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $data = [];

        if ($user->hasRole('Director')) {
            // Resumen para director: promedios por grupo, actividad reciente y reuniones próximas
            $promedios = Grupo::with('evaluaciones')
                ->get()
                ->map(function ($grupo) {
                    $notas = $grupo->evaluaciones->pluck('nota');
                    return [
                        'grupo' => $grupo->nombre,
                        'promedio' => $notas->count() ? round($notas->avg(), 2) : null,
                    ];
                });
            $actividades = [];
            $reuniones = Reunion::with('grupo')
                ->where('fecha', '>=', now())
                ->orderBy('fecha')
                ->limit(5)
                ->get()
                ->map(fn ($r) => [
                    'grupo' => $r->grupo->nombre,
                    'fecha' => $r->fecha->format('d/m/Y H:i'),
                    'tema' => $r->tema,
                ]);
            $data = [
                'promedios' => $promedios,
                'reuniones' => $reuniones,
                'actividades' => $actividades,
            ];
        } elseif ($user->hasRole('Docente')) {
            // Resumen para docente: grupos asignados y próximas reuniones
            $grupos = $user->grupos()->with('centro')->get()->map(fn ($g) => [
                'id' => $g->id,
                'nombre' => $g->nombre,
                'centro' => $g->centro->nombre,
            ]);
            $reuniones = $user->reuniones()->with('grupo')
                ->where('fecha', '>=', now())
                ->orderBy('fecha')
                ->limit(5)
                ->get()
                ->map(fn ($r) => [
                    'grupo' => $r->grupo->nombre,
                    'fecha' => $r->fecha->format('d/m/Y H:i'),
                    'tema' => $r->tema,
                ]);
            $data = [
                'grupos' => $grupos,
                'reuniones' => $reuniones,
            ];
        }

        return Inertia::render('Dashboard', [
            'data' => $data,
            'usuario' => [
                'nombre' => $user->name,
                'rol' => $user->getRoleNames()->first(),
            ],
        ]);
    }
}