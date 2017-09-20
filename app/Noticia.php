<?php

namespace App;

class Noticia extends Model
{
	protected $dates = ['data_final'];

	public function admin() {
   return $this->belongsTo(Admin::class);
 }

 public function empresa() {
  return $this->belongsTo(Empresa::class);
}

public function freelancer() {
  return $this->belongsTo(Freelancer::class);
}
}