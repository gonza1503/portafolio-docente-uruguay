<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('reuniones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('grupo_id')->constrained('grupos')->cascadeOnDelete();
            $table->dateTime('fecha');
            $table->string('tema');
            $table->text('observaciones')->nullable();
            $table->timestamps();
        });

        Schema::create('reunion_docente', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reunion_id')->constrained('reuniones')->cascadeOnDelete();
            $table->foreignId('docente_id')->constrained('users')->cascadeOnDelete();
            $table->timestamps();
            $table->unique(['reunion_id', 'docente_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reunion_docente');
        Schema::dropIfExists('reuniones');
    }
};