<?php

namespace App;

class Conhecimento extends Model
{
  public function empresas() {
    return $this->belongsToMany(Empresa::class);
  }
}