<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\FreelancerResetPasswordNotification;

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
      ->withPivot('aceito')
      ->withPivot('avaliado')
      ->withPivot('avaliado_freela');
    }

    public function jobs() {
      return $this->belongsToMany(Job::class);
    }

    public function conhecimentos() {
      return $this->belongsToMany(Conhecimento::class)
      ->withPivot('tempo_experiencia');
    }

    public function grupoAdmin() {
      return $this->hasMany(Grupo::class);
    }

    public function grupos() {
      return $this->belongsToMany(Grupo::class)
      ->withPivot('aceito');
    }

    public function portifolios() {
      return $this->hasMany(Portifolio::class);
    }

    public function comentarios() {
      return $this->hasMany(Comentario::class);
    }

    public function sendPasswordResetNotification($token) {
      $this->notify(new FreelancerResetPasswordNotification($token));
    }

    public function mensagens() {
      return $this->hasMany(Mensagen::class);
    }

    public function pontuacoes() {
      return $this->belongsToMany(Pontuacoe::class);
    }

    public function avaliacoes1() {
      return $this->hasMany(Avaliacoe::class);
    }

    public function avaliacoes2() {
      return $this->hasMany(Avaliacoe::class);
    }
  }