<?php

namespace App;

class Comentario extends Model
{
 public function empresa() {
  return $this->belongsTo(Empresa::class);
}

public function freelancer() {
  return $this->belongsTo(Freelancer::class);
}

public function job() {
  return $this->belongsTo(Job::class);
}
}