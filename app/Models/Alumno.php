<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modelo Alumno
 *
 * Representa a un estudiante inscrito en un grupo. Cada alumno tiene una
 * cédula de identidad única y múltiples evaluaciones y asistencias.
 */
class Alumno extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'cedula',
        'grupo_id',
    ];

    /**
     * El grupo al que pertenece el alumno.
     */
    public function grupo()
    {
        return $this->belongsTo(Grupo::class);
    }

    /**
     * Evaluaciones del alumno.
     */
    public function evaluaciones()
    {
        return $this->hasMany(Evaluacion::class);
    }

    /**
     * Asistencias del alumno.
     */
    public function asistencias()
    {
        return $this->hasMany(Asistencia::class);
    }
}