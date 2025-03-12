<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class UserAdmin extends Model
{
  protected $fillable = ['Nombre', 'Email', 'Password'];
  protected $hidden = ['Password'];
  public function setPasswordAttribute($value)
  {
    $this->attributes['password'] = Hash::make($value);
  }
  public $timestamps = true;
}
