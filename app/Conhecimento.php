<?php

namespace App;

class Conhecimento extends Model
{
  public function empresas() {
    return $this->belongsToMany(Empresa::class);
  }

  public function freelancers() {
    return $this->belongsToMany(Freelancer::class);
  }

  public function jobs() {
    return $this->belongsToMany(Job::class);
  }
}