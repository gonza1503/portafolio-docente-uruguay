<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('evaluaciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('alumno_id')->constrained('alumnos')->cascadeOnDelete();
            $table->foreignId('docente_id')->constrained('users')->cascadeOnDelete();
            $table->string('periodo');
            $table->string('actividad')->nullable();
            $table->decimal('nota', 4, 2); // 0.00–12.00
            $table->text('observaciones')->nullable();
            $table->timestamp('locked_at')->nullable();
            $table->timestamps();
            // Índices para búsqueda
            $table->index(['periodo', 'actividad']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('evaluaciones');
    }
};