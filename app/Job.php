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
}