<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modelo Centro
 *
 * Representa a una institución educativa (instituto o escuela). Un director
 * está asignado como responsable y el centro puede tener muchos grupos y
 * docentes asignados.
 */
class Centro extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'direccion',
        'director_id',
    ];

    /**
     * Director asignado al centro.
     */
    public function director()
    {
        return $this->belongsTo(User::class, 'director_id');
    }

    /**
     * Grupos asociados al centro.
     */
    public function grupos()
    {
        return $this->hasMany(Grupo::class);
    }

    /**
     * Docentes asignados al centro (relación N:M).
     */
    public function docentes()
    {
        return $this->belongsToMany(User::class, 'centro_user');
    }
}