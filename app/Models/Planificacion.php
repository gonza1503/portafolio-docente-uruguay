<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modelo Planificacion
 *
 * Permite al docente planificar sus clases indicando objetivos, contenidos,
 * estrategias, evaluación prevista y duración. Se pueden duplicar
 * planificaciones anteriores.
 */
class Planificacion extends Model
{
    use HasFactory;

    protected $fillable = [
        'grupo_id',
        'docente_id',
        'objetivo',
        'contenido',
        'estrategias',
        'evaluacion_prevista',
        'fecha',
        'duracion_min',
    ];

    protected $dates = ['fecha'];

    public function grupo()
    {
        return $this->belongsTo(Grupo::class);
    }

    public function docente()
    {
        return $this->belongsTo(User::class, 'docente_id');
    }
}