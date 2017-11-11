<?php

namespace App;

class Grupo extends Model
{
  public function freelancer() {
    return $this->belongsTo(Freelancer::class);
  }

  public function jobs() {
    return $this->belongsTo(Job::class);
  }

  public function freelancers() {
    return $this->belongsToMany(Freelancer::class);
  }
}