<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modelo Reunion
 *
 * Representa una reunión de docentes programada para un grupo.
 */
class Reunion extends Model
{
    use HasFactory;

    protected $fillable = [
        'grupo_id',
        'fecha',
        'tema',
        'observaciones',
    ];

    protected $dates = ['fecha'];

    public function grupo()
    {
        return $this->belongsTo(Grupo::class);
    }

    public function docentes()
    {
        return $this->belongsToMany(User::class, 'reunion_docente');
    }
}