<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('asistencias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('alumno_id')->constrained('alumnos')->cascadeOnDelete();
            $table->date('fecha');
            $table->enum('estado', ['Presente', 'Ausente', 'Tarde']);
            $table->timestamps();
            $table->unique(['alumno_id', 'fecha']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('asistencias');
    }
};