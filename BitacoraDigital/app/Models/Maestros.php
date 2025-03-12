<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Maestros extends Model
{
  protected $fillable = ['Nombre', 'Apellidos', 'Usuario', 'password', 'Telefono', 'Correo', 'Status'];

  public function setPasswordAttribute($value)
  {
    $this->attributes['password'] = Hash::make($value);
  }
}
