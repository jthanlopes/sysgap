<?php

namespace App;

class Grupo extends Model
{
  public function freelancer() {
    return $this->belongsTo(Freelancer::class);
  }
}