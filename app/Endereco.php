<?php

namespace App;

class Endereco extends Model {
  /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
  protected $fillable = [
    'logradouro', 'numero', 'cep', 'complemento', 'bairro', 'cidade', 'uf', 'created_at', 'freelancer_id',
  ];

  public function empresa() {
    return $this->hasOne(Empresa::class);
  }

  public function freelancer() {
    return $this->hasOne(Freelancer::class);
  }
}