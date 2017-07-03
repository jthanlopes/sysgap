<?php

namespace App;

class Freelancer extends Model {

	public function endereco() {
		return $this->hasOne(Endereco::class);
	}

	public function cadastrarEndereco(Endereco $endereco) {
    $this->enderecos()->save($endereco);
  }
}