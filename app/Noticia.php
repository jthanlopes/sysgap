<?php

namespace App;

class Noticia extends Model
{
	protected $dates = ['data_final'];

	public function admin() {
    	return $this->belongsTo(Admin::class);
    }
}