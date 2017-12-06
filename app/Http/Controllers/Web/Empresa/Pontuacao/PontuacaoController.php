<?php

namespace App\Http\Controllers\Web\Empresa\Pontuacao;

use Auth;
use App\Pontuacoe;
use App\Empresa;
use Illuminate\Http\Request;

class PontuacaoController extends Controller
{
  public function __construct() {
    $this->middleware('auth:empresa');
  }

  public function pontuacoesView() {
    $id = Auth::user()->id;
    $empresa = Empresa::find($id);
    $pontuacoesRetirar = $empresa->pontuacoes()->select('pontuacoe_id')->get()->pluck('pontuacoe_id')->toArray();
    $pontuacoes = Pontuacoe::whereNotIn('id', $pontuacoesRetirar)->get();
    $pontuacoesEmpresa = $empresa->pontuacoes;
    $total = $empresa->pontuacoes->sum('valor');
    $notificacoes = $empresa->projetos()->where('aceito', '=', 0)->get();

    return view('site.empresa.pontuacao.pontuacoes-view', compact('empresa', 'pontuacoes', 'notificacoes', 'pontuacoesEmpresa', 'total'));
  }
}
