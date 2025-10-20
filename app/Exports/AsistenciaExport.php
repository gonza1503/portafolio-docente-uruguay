<?php

namespace App\Exports;

use App\Models\Asistencia;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AsistenciaExport implements FromCollection, WithHeadings
{
    protected $grupoId;

    public function __construct(?int $grupoId)
    {
        $this->grupoId = $grupoId;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $query = Asistencia::with('alumno.grupo');
        if ($this->grupoId) {
            $query->whereHas('alumno', fn($q) => $q->where('grupo_id', $this->grupoId));
        }
        return $query->get()->map(function ($a) {
            return [
                'Grupo' => $a->alumno->grupo->nombre,
                'Alumno' => $a->alumno->nombre,
                'Fecha' => $a->fecha->format('d/m/Y'),
                'Estado' => $a->estado,
            ];
        });
    }

    public function headings(): array
    {
        return ['Grupo', 'Alumno', 'Fecha', 'Estado'];
    }
}