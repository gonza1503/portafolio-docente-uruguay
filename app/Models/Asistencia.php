<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modelo Asistencia
 *
 * Registra la asistencia de un alumno a una clase en una fecha específica.
 */
class Asistencia extends Model
{
    use HasFactory;

    protected $fillable = [
        'alumno_id',
        'fecha',
        'estado',
    ];

    protected $dates = ['fecha'];

    public function alumno()
    {
        return $this->belongsTo(Alumno::class);
    }
}