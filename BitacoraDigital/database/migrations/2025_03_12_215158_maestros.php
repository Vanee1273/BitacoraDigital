<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Laravel\Prompts\Table;

return new class extends Migration
{
  public function up(): void
  {
    Schema::create('Maestros', function (Blueprint $table) {
      $table->id();
      $table->string('Nombre');
      $table->string('Apellidos');
      $table->string('Usuario');
      $table->string('Password');
      $table->string('Telefono');
      $table->string('Correo');
      $table->enum('Status', ['Activo', 'Inactivo'])->nullable();
      $table->timestamps();
    });
  }
  public function down(): void
  {
    Schema::dropIfExists('Maestros');
  }
};
