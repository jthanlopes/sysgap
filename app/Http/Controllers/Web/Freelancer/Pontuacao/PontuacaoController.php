<?php

namespace App\Http\Controllers\Web\Freelancer\Pontuacao;

use Auth;
use App\Pontuacoe;
use App\Freelancer;
use Illuminate\Http\Request;

class PontuacaoController extends Controller
{
  public function __construct() {
    $this->middleware('auth:freelancer');
  }

  public function pontuacoesView() {
    $id = Auth::user()->id;
    $freelancer = Freelancer::find($id);
    $pontuacoesRetirar = $freelancer->pontuacoes()->select('pontuacoe_id')->get()->pluck('pontuacoe_id')->toArray();
    array_push($pontuacoesRetirar, 7, 8);
    $pontuacoes = Pontuacoe::whereNotIn('id', $pontuacoesRetirar)->get();
    $pontuacoesFreelancer = $freelancer->pontuacoes;
    $total = $freelancer->pontuacoes->sum('valor');
    $notificacoes = $freelancer->projetos()->where('aceito', '=', 0)->get();
    $notificacoes2 = $freelancer->grupos()->where('aceito', '=', 0)->get();

    return view('site.freelancer.pontuacao.pontuacoes-view', compact('freelancer', 'pontuacoes', 'notificacoes', 'notificacoes2', 'pontuacoesFreelancer', 'total'));
  }
}
