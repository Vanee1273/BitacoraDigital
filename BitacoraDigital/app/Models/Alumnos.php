<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alumnos extends Model
{
  protected $fillable = ['NumeroControl', 'Nombre', 'Apellidos', 'Grado', 'Grupo', 'Status'];
  public $timestamps = true;
}
