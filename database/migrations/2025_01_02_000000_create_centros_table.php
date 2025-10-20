<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('centros', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('direccion')->nullable();
            $table->foreignId('director_id')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });

        // Tabla pivote entre centros y usuarios (docentes)
        Schema::create('centro_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('centro_id')->constrained('centros')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->timestamps();
            $table->unique(['centro_id', 'user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('centro_user');
        Schema::dropIfExists('centros');
    }
};