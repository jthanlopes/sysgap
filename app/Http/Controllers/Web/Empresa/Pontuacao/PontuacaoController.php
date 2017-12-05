<?php

namespace App\Http\Controllers\Web\Empresa\Pontuacao;

use Auth;
use App\Pontuacoe;
use Illuminate\Http\Request;

class PontuacaoController extends Controller
{
  public function __construct() {
    $this->middleware('auth:empresa');
  }

  public function pontuacoesView() {
    $id = Auth::user()->id;
    $empresa = Empresa::find($id);
    $pontuacoes = Pontuacoe::all();
    $notificacoes = $empresa->projetos()->where('aceito', '=', 0)->get();

    return view('site.empresa.portifolio.pontuacoes-view', compact('empresa', 'pontuacoes', 'notificacoes'));
  }
}
