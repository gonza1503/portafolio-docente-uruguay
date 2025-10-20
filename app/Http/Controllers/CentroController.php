<?php

namespace App\Http\Controllers;

use App\Models\Centro;
use Illuminate\Http\Request;
use Inertia\Inertia;

/**
 * Controlador Centro
 *
 * Permite al director gestionar los centros educativos.
 */
class CentroController extends Controller
{
    /**
     * Listado de centros.
     */
    public function index()
    {
        $centros = Centro::with('director')->paginate(10);
        return Inertia::render('Centros/Index', [
            'centros' => $centros,
        ]);
    }

    /**
     * Muestra el formulario de creación.
     */
    public function create()
    {
        return Inertia::render('Centros/Create');
    }

    /**
     * Guarda un nuevo centro.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'direccion' => 'nullable|string|max:255',
        ]);
        $centro = Centro::create($data + ['director_id' => $request->user()->id]);
        return redirect()->route('centros.index');
    }

    /**
     * Muestra la vista de edición.
     */
    public function edit(Centro $centro)
    {
        return Inertia::render('Centros/Edit', [
            'centro' => $centro,
        ]);
    }

    /**
     * Actualiza el centro.
     */
    public function update(Request $request, Centro $centro)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'direccion' => 'nullable|string|max:255',
        ]);
        $centro->update($data);
        return redirect()->route('centros.index');
    }

    /**
     * Elimina el centro.
     */
    public function destroy(Centro $centro)
    {
        $centro->delete();
        return redirect()->route('centros.index');
    }
}