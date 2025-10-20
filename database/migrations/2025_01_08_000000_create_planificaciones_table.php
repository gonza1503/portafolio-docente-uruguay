<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('planificaciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('grupo_id')->constrained('grupos')->cascadeOnDelete();
            $table->foreignId('docente_id')->constrained('users')->cascadeOnDelete();
            $table->text('objetivo');
            $table->text('contenido');
            $table->text('estrategias')->nullable();
            $table->text('evaluacion_prevista')->nullable();
            $table->date('fecha');
            $table->integer('duracion_min')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('planificaciones');
    }
};