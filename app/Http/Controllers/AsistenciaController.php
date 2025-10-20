<?php

namespace App\Http\Controllers;

use App\Models\{Asistencia,Alumno,Grupo};
use Illuminate\Http\Request;
use Inertia\Inertia;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AsistenciaExport;
use Barryvdh\DomPDF\Facade as PDF;

/**
 * Controlador Asistencia
 *
 * Permite registrar asistencias y exportar reportes en PDF o Excel.
 */
class AsistenciaController extends Controller
{
    /**
     * Listado de asistencias por grupo o alumno.
     */
    public function index(Request $request)
    {
        $grupoId = $request->query('grupo_id');
        $query = Asistencia::with('alumno.grupo');
        if ($grupoId) {
            $query->whereHas('alumno', fn($q) => $q->where('grupo_id', $grupoId));
        }
        $asistencias = $query->orderBy('fecha', 'desc')->paginate(20);
        return Inertia::render('Asistencias/Index', [
            'asistencias' => $asistencias,
        ]);
    }

    /**
     * Registra asistencias para un grupo en una fecha.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'fecha' => 'required|date',
            'asistencias' => 'required|array',
            'asistencias.*.alumno_id' => 'required|exists:alumnos,id',
            'asistencias.*.estado' => 'required|in:Presente,Ausente,Tarde',
        ]);
        foreach ($data['asistencias'] as $row) {
            Asistencia::updateOrCreate(
                ['alumno_id' => $row['alumno_id'], 'fecha' => $data['fecha']],
                ['estado' => $row['estado']]
            );
        }
        return back();
    }

    /**
     * Exporta las asistencias a Excel.
     */
    public function exportExcel(Request $request)
    {
        $grupoId = $request->query('grupo_id');
        return Excel::download(new AsistenciaExport($grupoId), 'asistencias.xlsx');
    }

    /**
     * Exporta las asistencias a PDF.
     */
    public function exportPdf(Request $request)
    {
        $grupoId = $request->query('grupo_id');
        $query = Asistencia::with('alumno.grupo');
        if ($grupoId) {
            $query->whereHas('alumno', fn($q) => $q->where('grupo_id', $grupoId));
        }
        $asistencias = $query->get();
        $pdf = PDF::loadView('pdf.asistencias', ['asistencias' => $asistencias]);
        return $pdf->download('asistencias.pdf');
    }
}