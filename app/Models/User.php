<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

/**
 * Modelo User
 *
 * Este modelo representa a los usuarios de la aplicación (directores y docentes).
 * Se integra con el paquete spatie/laravel-permission para gestionar roles y
 * permisos y con Sanctum para la autenticación vía API.
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * Atributos asignables en masa.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * Atributos que deben ocultarse para arrays.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Casts de atributos.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Relación con centros asignados (N:M).
     */
    public function centros()
    {
        return $this->belongsToMany(Centro::class, 'centro_user');
    }

    /**
     * Relación con grupos (solo docentes).
     * Incluye el campo adicional 'materia'.
     */
    public function grupos()
    {
        return $this->belongsToMany(Grupo::class, 'docente_grupo')
                    ->withPivot('materia')
                    ->withTimestamps();
    }

    /**
     * Relación con evaluaciones realizadas por el docente.
     */
    public function evaluaciones()
    {
        return $this->hasMany(Evaluacion::class, 'docente_id');
    }

    /**
     * Reuniones a las que el docente ha sido invitado.
     */
    public function reuniones()
    {
        return $this->belongsToMany(Reunion::class, 'reunion_docente', 'docente_id', 'reunion_id');
    }
}