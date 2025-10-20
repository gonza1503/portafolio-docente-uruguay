<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * Modelo pivot ReunionDocente
 *
 * Intermedia la relación N:M entre reuniones y docentes.
 */
class ReunionDocente extends Pivot
{
    protected $table = 'reunion_docente';
}