<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id(); // Columna "id" autoincremental
            $table->string('nombre'); // Columna para el nombre
            $table->string('correo')->unique(); // Columna para el correo (único)
            $table->string('password'); // Columna para la contraseña
            $table->timestamps(); // Columnas "created_at" y "updated_at"
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins'); // Eliminar la tabla si se revierte la migración
    }
};