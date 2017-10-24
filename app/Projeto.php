<?php

namespace App;

class Projeto extends Model
{
  protected $dates = ['created_at'];

  public function jobs() {
    return $this->hasMany(Job::class);
  }

  public function empresa() {
   return $this->belongsTo(Empresa::class);
 }

 public function freelancers() {
  return $this->belongsToMany(Freelancer::class);
}
}