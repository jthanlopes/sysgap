<?php

namespace App;
use Illuminate\Notifications\Notifiable;

class Projeto extends Model
{
  use Notifiable;

  public function jobs() {
    return $this->hasMany(Job::class);
  }

  public function empresa() {
   return $this->belongsTo(Empresa::class);
 }
}