<?php

namespace App\Http\Controllers\Web\Empresa\Avaliacao;

use Auth;
use App\Avaliacao;
use App\Freelancer;
use App\Projeto;
use App\Item;
use Illuminate\Http\Request;

class AvaliacaoController extends Controller
{
  public function __construct() {
    $this->middleware('auth:empresa');
  }

  public function avaliarFreelancer(Projeto $projeto, Freelancer $freelancer) {
    $items = Item::all();
    return view('site.empresa.avaliacao.avaliacao-freelancer', compact('freelancer', 'items'));
  }
}
