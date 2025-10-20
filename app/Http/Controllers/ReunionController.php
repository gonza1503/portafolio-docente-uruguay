<?php

namespace App\Http\Controllers;

use App\Models\{Reunion,Grupo,User};
use Illuminate\Http\Request;
use Inertia\Inertia;

/**
 * Controlador Reunion
 *
 * Permite crear y listar reuniones de profesores.
 */
class ReunionController extends Controller
{
    /**
     * Listado de reuniones.
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $query = Reunion::with('grupo');
        if ($user->hasRole('Docente')) {
            // Ver solo las reuniones a las que está invitado
            $query->whereHas('docentes', fn($q) => $q->where('users.id', $user->id));
        }
        $reuniones = $query->orderBy('fecha', 'desc')->paginate(10);
        return Inertia::render('Reuniones/Index', [
            'reuniones' => $reuniones,
        ]);
    }

    /**
     * Formulario de creación.
     */
    public function create()
    {
        return Inertia::render('Reuniones/Create');
    }

    /**
     * Guarda una reunión.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'grupo_id' => 'required|exists:grupos,id',
            'fecha' => 'required|date',
            'hora' => 'nullable',
            'tema' => 'required|string|max:255',
            'observaciones' => 'nullable|string',
            'docentes' => 'required|array',
            'docentes.*' => 'exists:users,id',
        ]);
        $fecha = $data['fecha'];
        $reunion = Reunion::create([
            'grupo_id' => $data['grupo_id'],
            'fecha' => $fecha,
            'tema' => $data['tema'],
            'observaciones' => $data['observaciones'] ?? null,
        ]);
        $reunion->docentes()->sync($data['docentes']);
        return redirect()->route('reuniones.index');
    }

    /**
     * Muestra una reunión.
     */
    public function show(Reunion $reunion)
    {
        $reunion->load('grupo', 'docentes');
        return Inertia::render('Reuniones/Show', [
            'reunion' => $reunion,
        ]);
    }
}