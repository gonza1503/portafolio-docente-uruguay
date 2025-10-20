<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use App\Models\Centro;
use Illuminate\Http\Request;
use Inertia\Inertia;

/**
 * Controlador Grupo
 *
 * Permite al director gestionar grupos y a los docentes acceder a sus grupos
 * asignados.
 */
class GrupoController extends Controller
{
    /**
     * Listado de grupos (director).
     */
    public function index(Request $request)
    {
        $grupos = Grupo::with('centro')->paginate(15);
        return Inertia::render('Grupos/Index', [
            'grupos' => $grupos,
        ]);
    }

    /**
     * Muestra detalles del grupo.
     */
    public function show(Grupo $grupo)
    {
        $grupo->load(['centro', 'alumnos', 'docentes']);
        return Inertia::render('Grupos/Show', [
            'grupo' => $grupo,
        ]);
    }

    /**
     * Muestra grupos asignados al docente.
     */
    public function misGrupos(Request $request)
    {
        $user = $request->user();
        $grupos = $user->grupos()->with('centro')->paginate(15);
        return Inertia::render('Grupos/MisGrupos', [
            'grupos' => $grupos,
        ]);
    }
}