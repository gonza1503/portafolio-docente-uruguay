<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modelo Grupo
 *
 * Representa un grupo dentro de un centro (por ejemplo “1°A”). Un grupo
 * pertenece a un centro y puede tener varios docentes asignados con
 * distintas materias. También se relaciona con alumnos, evaluaciones,
 * planificaciones, etc.
 */
class Grupo extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'centro_id',
    ];

    /**
     * Centro al que pertenece el grupo.
     */
    public function centro()
    {
        return $this->belongsTo(Centro::class);
    }

    /**
     * Docentes asignados al grupo.
     */
    public function docentes()
    {
        return $this->belongsToMany(User::class, 'docente_grupo')
                    ->withPivot('materia')
                    ->withTimestamps();
    }

    /**
     * Alumnos pertenecientes al grupo.
     */
    public function alumnos()
    {
        return $this->hasMany(Alumno::class);
    }

    /**
     * Evaluaciones asociadas al grupo a través de los alumnos.
     */
    public function evaluaciones()
    {
        return $this->hasManyThrough(Evaluacion::class, Alumno::class);
    }

    /**
     * Actividades grupales.
     */
    public function actividades()
    {
        return $this->hasMany(ActividadGrupo::class);
    }

    /**
     * Desarrollo de clases.
     */
    public function desarrollos()
    {
        return $this->hasMany(DesarrolloClase::class);
    }

    /**
     * Planificaciones.
     */
    public function planificaciones()
    {
        return $this->hasMany(Planificacion::class);
    }

    /**
     * Asistencias (a través de alumnos).
     */
    public function asistencias()
    {
        return $this->hasManyThrough(Asistencia::class, Alumno::class);
    }

    /**
     * Reuniones programadas para el grupo.
     */
    public function reuniones()
    {
        return $this->hasMany(Reunion::class);
    }
}