<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modelo ActividadGrupo
 *
 * Representa una actividad grupal (taller, salida, examen general, etc.).
 */
class ActividadGrupo extends Model
{
    use HasFactory;

    protected $fillable = [
        'grupo_id',
        'nombre',
        'fecha',
        'descripcion',
    ];

    protected $dates = ['fecha'];

    public function grupo()
    {
        return $this->belongsTo(Grupo::class);
    }
}