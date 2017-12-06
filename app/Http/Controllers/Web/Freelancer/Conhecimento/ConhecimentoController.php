<?php

namespace App\Http\Controllers\Web\Freelancer\Conhecimento;

use App\Conhecimento;
use App\Freelancer;
use Auth;

use Illuminate\Http\Request;

class ConhecimentoController extends Controller
{
  public function __construct() {
    $this->middleware('auth:freelancer');
  }

  public function conhecimentosView() {
    $id = Auth::user()->id;
    $freelancer = Freelancer::find($id);
    $freelancerConhe = $freelancer->conhecimentos()->select('id')->get()->pluck('id')->toArray();
    $conhecimentos = Conhecimento::orderBy('titulo')->wherenotin('id', $freelancerConhe)->get();
    $notificacoes = $freelancer->projetos()->where('aceito', '=', 0)->get();
    $notificacoes2 = $freelancer->grupos()->where('aceito', '=', 0)->get();

    return view('site.freelancer.conhecimento.conhecimentos-view', compact('freelancer', 'conhecimentos', 'notificacoes', 'notificacoes2'));
  }

  public function addConhecimento(Request $request) {
    $id = $request->get('tecnologia');
    $conhecimento = Conhecimento::find($id);
    $tempo_experiencia = $request->tempo_experiencia;
    $freelancer = Auth::user();
    $add = $freelancer->conhecimentos()->attach($conhecimento, ['created_at' => new \DateTime(), 'updated_at' => new \DateTime(),
      'tempo_experiencia' => $tempo_experiencia]);

    $message = parent::returnMessage('success', 'Conhecimento adicionado com sucesso!');

    $verificaPontuacao = $freelancer->pontuacoes()->where('pontuacoe_id', 5)->count();

    if($verificaPontuacao == 0) {
      $pontuacaoId = 5;

      $freelancer->pontuacoes()->attach($pontuacaoId, ['created_at' => new \DateTime(), 'updated_at' => new \DateTime()]);
    }

    return redirect()->route('tecnologias.view.freelancer')->with('message', $message);
  }

  public function excluirConhecimento(Conhecimento $conhecimento) {
    $freelancer = Auth::user();
    $freelancer->conhecimentos()->detach($conhecimento);

    $message = parent::returnMessage('success', 'Conhecimento removido com sucesso!');

    return redirect()->route('tecnologias.view.freelancer')->with('message', $message);
  }
}
