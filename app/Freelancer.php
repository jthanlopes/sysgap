<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Freelancer extends Authenticatable {
  use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    'nome', 'email', 'password', 'cpf', 'ativo', 'foto_perfil', 'pontuacao', 'avaliacao_geral', 'endereco_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    'password', 'remember_token',
    ];

    public function endereco() {
      return $this->hasOne(Endereco::class);
    }

    public function cadastrarEndereco(Endereco $endereco) {
      $this->enderecos()->save($endereco);
    }
  }