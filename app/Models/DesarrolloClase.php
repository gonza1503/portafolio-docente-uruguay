<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modelo DesarrolloClase
 *
 * Registra lo trabajado en una clase por un docente en un grupo determinado.
 */
class DesarrolloClase extends Model
{
    use HasFactory;

    protected $fillable = [
        'grupo_id',
        'docente_id',
        'texto',
        'fecha',
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