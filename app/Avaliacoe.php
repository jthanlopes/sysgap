<?php

namespace App;

class Avaliacoe extends Model
{
 public function empresaAvaliadora() {
  return $this->belongsTo(Empresa::class);
}

public function freelancerAvaliador() {
  return $this->belongsTo(Freelancer::class);
}
public function empresaAvaliada() {
  return $this->belongsTo(Empresa::class);
}

public function freelancerAvaliado() {
  return $this->belongsTo(Freelancer::class);
}

public function item() {
  return $this->belongsTo(Item::class);
}
}