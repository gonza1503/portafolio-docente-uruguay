<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modelo Evaluacion
 *
 * Representa una evaluación individual de un alumno en un periodo o actividad
 * específica. Permite registrar la nota y observaciones. Se puede cerrar
 * mediante el campo locked_at para impedir ediciones posteriores.
 */
class Evaluacion extends Model
{
    use HasFactory;

    protected $fillable = [
        'alumno_id',
        'docente_id',
        'periodo',
        'actividad',
        'nota',
        'observaciones',
        'locked_at',
    ];

    protected $dates = [
        'locked_at',
    ];

    /**
     * El alumno evaluado.
     */
    public function alumno()
    {
        return $this->belongsTo(Alumno::class);
    }

    /**
     * El docente que realizó la evaluación.
     */
    public function docente()
    {
        return $this->belongsTo(User::class, 'docente_id');
    }

    /**
     * Determina si la evaluación está cerrada y no se puede modificar.
     */
    public function getEstaCerradaAttribute(): bool
    {
        return !is_null($this->locked_at);
    }
}