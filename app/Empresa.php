<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\EmpresaResetPasswordNotification;

class Empresa extends Authenticatable
{
  use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'id', 'nome', 'email', 'password', 'cnpj', 'categoria', 'endereco_id', 'foto_perfil', 'pontuacao',
      'avaliacao_geral' ,'ativo', 'account_confirmation',
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

    public function jobs() {
      return $this->hasMany(Job::class);
    }

    public function projeto() {
      return $this->hasMany(Projeto::class);
    }

    public function cadastrarJob(Job $job) {
      $this->jobs()->save($job);
    }

    public function noticias() {
      return $this->hasMany(Noticia::class);
    }

    public function conhecimentos() {
      return $this->belongsToMany(Conhecimento::class);
    }

    public function projetos() {
      return $this->belongsToMany(Projeto::class)
      ->withPivot('aceito')
      ->withPivot('avaliado')
      ->withPivot('avaliado_prod');
    }

    public function portifolios() {
      return $this->hasMany(Portifolio::class);
    }

    public function jobsProd() {
      return $this->belongsToMany(Job::class);
    }

    public function comentarios() {
      return $this->hasMany(Comentario::class);
    }

    public function sendPasswordResetNotification($token) {
      $this->notify(new EmpresaResetPasswordNotification($token));
    }

    public function mensagens() {
      return $this->hasMany(Mensagen::class);
    }

    public function pontuacoes() {
      return $this->belongsToMany(Pontuacoe::class);
    }

    public function avaliacoes() {
      return $this->hasMany(Avaliacoe::class);
    }
  }