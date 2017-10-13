<?php

namespace App\Http\Controllers\Web\Empresa\Conhecimento;

use App\Conhecimento;
use Auth;

use Illuminate\Http\Request;

class ConhecimentoController extends Controller
{
  public function __construct() {
    $this->middleware('auth:empresa');
  }

  public function addConhecimento() {
    $conhecimento = Conhecimento::find(2);
    $empresa = Auth::user();
    $empresa->conhecimentos()->attach($conhecimento);
  }
}
