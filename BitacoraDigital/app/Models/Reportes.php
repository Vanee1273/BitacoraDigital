<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reportes extends Model
{
  protected $table = 'Reportes';

  protected $fillable = [
    'Motivos',
    'Descripción',
    'FKIDAlumno',
    'FKIDMaestro',
    'Status'
  ];
  public $timestamps = true;
}
