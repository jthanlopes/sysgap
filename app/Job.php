<?php

namespace App;

class Job extends Model
{
	public function empresa() {
   return $this->belongsTo(Empresa::class);
 }

 public function projeto() {
  return $this->belongsTo(Projeto::class);
}

public function freelancers() {
  return $this->belongsToMany(Freelancer::class);
}

public function empresas() {
  return $this->belongsToMany(Empresa::class);
}

public function conhecimentos() {
  return $this->belongsToMany(Conhecimento::class);
}

public function grupos() {
  return $this->belongsTo(Grupo::class);
}
}