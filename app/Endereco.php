<?php

namespace App;

class Endereco extends Model {
	public function empresa() {
		return $this->hasOne(Empresa::class);
	}

	public function freelancer() {
		return $this->hasOne(Freelancer::class);
	}
}