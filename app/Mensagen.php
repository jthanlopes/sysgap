<?php

namespace App;

class Mensagen extends Model
{
 public function empresa() {
  return $this->belongsTo(Empresa::class);
}

public function freelancer() {
  return $this->belongsTo(Freelancer::class);
}
}