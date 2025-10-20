<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('grupos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->foreignId('centro_id')->constrained('centros')->restrictOnDelete();
            $table->timestamps();
            // Unicidad del nombre por centro
            $table->unique(['nombre', 'centro_id']);
        });

        // Tabla pivote docente-grupo
        Schema::create('docente_grupo', function (Blueprint $table) {
            $table->id();
            $table->foreignId('grupo_id')->constrained('grupos')->cascadeOnDelete();
            $table->foreignId('docente_id')->constrained('users')->cascadeOnDelete();
            $table->string('materia');
            $table->timestamps();
            $table->unique(['docente_id', 'grupo_id', 'materia'], 'docente_grupo_unico');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('docente_grupo');
        Schema::dropIfExists('grupos');
    }
};