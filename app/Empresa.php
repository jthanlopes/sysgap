<?php

namespace App;

class Empresa extends Model {

	public function endereco() {
		return $this->hasOne(Endereco::class);
	}
}