<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
  {
    Schema::create('Reportes', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('FKIDMaestro');
      $table->unsignedBigInteger('FKIDAlumno');
      $table->string('Motivos');
      $table->text('Descripción');
      $table->enum('Status', ['Leído', 'No Leído'])->nullable();
      $table->timestamps();
  
      $table->foreign('FKIDMaestro')->references('id')->on('Maestros')->onDelete('cascade');
      $table->foreign('FKIDAlumno')->references('id')->on('Alumnos')->onDelete('cascade');
  });
  }
  public function down(): void
  {
    Schema::dropIfExists('Maestros');
  }
};
