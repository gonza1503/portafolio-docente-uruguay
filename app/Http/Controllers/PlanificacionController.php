<?php

namespace App\Http\Controllers;

use App\Models\Planificacion;
use App\Models\Grupo;
use Illuminate\Http\Request;
use Inertia\Inertia;

/**
 * Controlador Planificacion
 *
 * Permite al docente crear, duplicar y editar sus planificaciones.
 */
class PlanificacionController extends Controller
{
    /**
     * Listado de planificaciones.
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $query = Planificacion::with('grupo');
        // Los docentes ven solo sus planificaciones
        if ($user->hasRole('Docente')) {
            $query->where('docente_id', $user->id);
        }
        $planificaciones = $query->paginate(20);
        return Inertia::render('Planificaciones/Index', [
            'planificaciones' => $planificaciones,
        ]);
    }

    /**
     * Formulario de creación.
     */
    public function create()
    {
        return Inertia::render('Planificaciones/Create');
    }

    /**
     * Guarda una nueva planificación.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'grupo_id' => 'required|exists:grupos,id',
            'objetivo' => 'required|string',
            'contenido' => 'required|string',
            'estrategias' => 'nullable|string',
            'evaluacion_prevista' => 'nullable|string',
            'fecha' => 'required|date',
            'duracion_min' => 'nullable|integer',
        ]);
        $data['docente_id'] = $request->user()->id;
        Planificacion::create($data);
        return redirect()->route('planificaciones.index');
    }

    /**
     * Edita una planificación.
     */
    public function edit(Planificacion $planificacion)
    {
        return Inertia::render('Planificaciones/Edit', [
            'planificacion' => $planificacion,
        ]);
    }

    /**
     * Actualiza la planificación.
     */
    public function update(Request $request, Planificacion $planificacion)
    {
        $data = $request->validate([
            'objetivo' => 'required|string',
            'contenido' => 'required|string',
            'estrategias' => 'nullable|string',
            'evaluacion_prevista' => 'nullable|string',
            'fecha' => 'required|date',
            'duracion_min' => 'nullable|integer',
        ]);
        $planificacion->update($data);
        return redirect()->route('planificaciones.index');
    }
}