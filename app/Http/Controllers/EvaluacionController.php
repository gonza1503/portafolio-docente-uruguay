<?php

namespace App\Http\Controllers;

use App\Models\{Evaluacion,Alumno,Grupo};
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Gate;

/**
 * Controlador Evaluacion
 *
 * Permite gestionar las evaluaciones de alumnos. Contiene funciones para
 * listar, crear y actualizar notas. Se aplica un bloqueo cuando el
 * periodo está cerrado.
 */
class EvaluacionController extends Controller
{
    /**
     * Listado de evaluaciones para un grupo o alumno.
     */
    public function index(Request $request)
    {
        $grupoId = $request->query('grupo_id');
        $alumnoId = $request->query('alumno_id');
        $query = Evaluacion::with(['alumno.grupo', 'docente']);
        if ($grupoId) {
            $query->whereHas('alumno', function ($q) use ($grupoId) {
                $q->where('grupo_id', $grupoId);
            });
        }
        if ($alumnoId) {
            $query->where('alumno_id', $alumnoId);
        }
        $evaluaciones = $query->paginate(20);
        return Inertia::render('Evaluaciones/Index', [
            'evaluaciones' => $evaluaciones,
        ]);
    }

    /**
     * Guarda una nueva evaluación.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'alumno_id' => 'required|exists:alumnos,id',
            'periodo' => 'required|string|max:50',
            'actividad' => 'nullable|string|max:255',
            'nota' => 'required|numeric|min:0|max:12',
            'observaciones' => 'nullable|string',
        ]);
        $data['docente_id'] = $request->user()->id;
        Evaluacion::create($data);
        return back();
    }

    /**
     * Actualiza una evaluación existente.
     */
    public function update(Request $request, Evaluacion $evaluacion)
    {
        // No permitir editar si está cerrada a menos que sea director
        if ($evaluacion->estaCerrada && !$request->user()->hasRole('Director')) {
            abort(403, 'El periodo está cerrado');
        }
        $data = $request->validate([
            'nota' => 'sometimes|numeric|min:0|max:12',
            'observaciones' => 'nullable|string',
        ]);
        $evaluacion->update($data);
        return back();
    }

    /**
     * Cierra el promedio del periodo (bloqueo de ediciones).
     */
    public function close(Request $request, Grupo $grupo, string $periodo)
    {
        // Director o docente puede cerrar; se bloquean ediciones posteriores
        $evaluaciones = Evaluacion::whereHas('alumno', fn ($q) => $q->where('grupo_id', $grupo->id))
            ->where('periodo', $periodo)
            ->get();
        foreach ($evaluaciones as $eva) {
            $eva->locked_at = now();
            $eva->save();
        }
        return back();
    }
}