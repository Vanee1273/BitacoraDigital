<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
  {
    Schema::create('UserAdmin', function (Blueprint $table) {
      $table->id();
      $table->string('Nombre');
      $table->string('Apellidos');
      $table->string('Usuario');
      $table->string('Password');
    });
  }
  public function down(): void
  {
    Schema::dropIfExists('UserAdmin');
  }
};
