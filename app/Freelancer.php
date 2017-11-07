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
      'nome', 'email', 'password', 'cpf', 'ativo', 'foto_perfil', 'pontuacao', 'avaliacao_geral', 'account_confirmation', 'endereco_id',
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
      return $this->belongsTo(Endereco::class);
    }

    public function cadastrarEndereco(Endereco $endereco) {
      $this->enderecos()->save($endereco);
    }

    public function noticias() {
      return $this->hasMany(Noticia::class);
    }

    public function cadastrarNoticia(Noticia $noticia) {
      $this->noticias()->save($noticia);
    }

    public function projetos() {
      return $this->belongsToMany(Projeto::class)
      ->withPivot('aceito');
    }

    public function jobs() {
      return $this->belongsToMany(Job::class);
    }

    public function conhecimentos() {
      return $this->belongsToMany(Conhecimento::class)
      ->withPivot('tempo_experiencia');
    }

    public function grupos() {
      return $this->hasMany(Grupo::class);
    }
  }