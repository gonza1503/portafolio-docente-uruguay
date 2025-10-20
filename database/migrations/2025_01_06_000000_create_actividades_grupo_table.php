<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('actividades_grupo', function (Blueprint $table) {
            $table->id();
            $table->foreignId('grupo_id')->constrained('grupos')->cascadeOnDelete();
            $table->string('nombre');
            $table->date('fecha');
            $table->text('descripcion')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('actividades_grupo');
    }
};