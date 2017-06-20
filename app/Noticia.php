<?php

namespace App;

class Noticia extends Model
{
	public function admin() {
    	return $this->belongsTo(Admin::class);
    }
}