<?php

namespace App;

class Item extends Model
{
  public function avaliacoes() {
    return $this->hasMany(Avaliacoe::class);
  }
}