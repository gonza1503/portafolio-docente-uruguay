<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\{User,Centro,Grupo,Alumno,Evaluacion,Planificacion,DesarrolloClase,Reunion};
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crear roles
        $rolDirector = Role::firstOrCreate(['name' => 'Director']);
        $rolDocente = Role::firstOrCreate(['name' => 'Docente']);

        // Crear director
        $director = User::firstOrCreate([
            'email' => 'director@example.com',
        ], [
            'name' => 'Director General',
            'password' => bcrypt('password'),
        ]);
        $director->assignRole($rolDirector);

        // Crear docentes
        $docentes = [];
        for ($i = 1; $i <= 3; $i++) {
            $docente = User::firstOrCreate([
                'email' => "docente$i@example.com",
            ], [
                'name' => "Docente $i",
                'password' => bcrypt('password'),
            ]);
            $docente->assignRole($rolDocente);
            $docentes[] = $docente;
        }

        // Crear centros
        $centros = [];
        $centros[] = Centro::create([
            'nombre' => 'Instituto Central',
            'direccion' => 'Montevideo, Uruguay',
            'director_id' => $director->id,
        ]);
        $centros[] = Centro::create([
            'nombre' => 'Escuela del Prado',
            'direccion' => 'Montevideo, Uruguay',
            'director_id' => $director->id,
        ]);

        // Asignar docentes a centros
        foreach ($centros as $centro) {
            $centro->docentes()->sync($docentes);
        }

        // Crear grupos
        $grupos = [];
        $grupoIndex = 1;
        foreach ($centros as $centro) {
            for ($i = 1; $i <= 3; $i++) {
                $nombre = $i . '°' . chr(ord('A') + ($grupoIndex - 1));
                $grupo = Grupo::create([
                    'nombre' => $nombre,
                    'centro_id' => $centro->id,
                ]);
                // Asignar docente al grupo con materia
                foreach ($docentes as $doc) {
                    $grupo->docentes()->attach($doc->id, ['materia' => 'Matemática']);
                }
                $grupos[] = $grupo;
                $grupoIndex++;
            }
        }

        // Crear alumnos (10 por grupo)
        foreach ($grupos as $grupo) {
            for ($i = 1; $i <= 10; $i++) {
                Alumno::create([
                    'nombre' => "Alumno {$grupo->nombre}-$i",
                    'cedula' => str_pad($grupo->id, 2, '0', STR_PAD_LEFT) . str_pad($i, 7, '0', STR_PAD_LEFT),
                    'grupo_id' => $grupo->id,
                ]);
            }
        }

        // Crear planificaciones de ejemplo (3)
        $fechaBase = Carbon::now()->startOfYear();
        for ($i = 0; $i < 3; $i++) {
            Planificacion::create([
                'grupo_id' => $grupos[$i]->id,
                'docente_id' => $docentes[$i % count($docentes)]->id,
                'objetivo' => 'Objetivo de la clase ' . ($i + 1),
                'contenido' => 'Contenidos de la clase ' . ($i + 1),
                'estrategias' => 'Estrategias didácticas',
                'evaluacion_prevista' => 'Observación en clase',
                'fecha' => $fechaBase->copy()->addDays($i),
                'duracion_min' => 90,
            ]);
        }

        // Crear registros de desarrollo de clase (10)
        for ($i = 0; $i < 10; $i++) {
            DesarrolloClase::create([
                'grupo_id' => $grupos[$i % count($grupos)]->id,
                'docente_id' => $docentes[$i % count($docentes)]->id,
                'texto' => 'Se trabajó en temas de ejemplo ' . ($i + 1),
                'fecha' => Carbon::now()->subDays($i),
            ]);
        }

        // Crear reunión de ejemplo
        $reunion = Reunion::create([
            'grupo_id' => $grupos[0]->id,
            'fecha' => Carbon::now()->addWeek(),
            'tema' => 'Coordinación de semestre',
            'observaciones' => 'Discutir lineamientos y calendarios.',
        ]);
        $reunion->docentes()->sync($docentes);

        // Crear evaluaciones y asistencias de ejemplo por periodo
        $periodos = ['Marzo-Abril', 'Mayo-Junio'];
        foreach ($grupos as $grupo) {
            foreach ($grupo->alumnos as $alumno) {
                foreach ($periodos as $periodo) {
                    foreach ($docentes as $doc) {
                        Evaluacion::create([
                            'alumno_id' => $alumno->id,
                            'docente_id' => $doc->id,
                            'periodo' => $periodo,
                            'actividad' => null,
                            'nota' => rand(6, 12),
                            'observaciones' => 'Observación de ejemplo',
                        ]);
                    }
                }
            }
        }
    }
}