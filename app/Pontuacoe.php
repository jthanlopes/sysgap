<?php

namespace App;

class Pontuacoe extends Model
{
  public function freelancers() {
    return $this->belongsToMany(Freelancer::class);
  }

  public function empresas() {
    return $this->belongsToMany(Empresa::class);
  }
}