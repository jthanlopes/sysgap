<?php

namespace App\Http\Controllers\Web\Freelancer\Avaliacao;

use App\Comentario;
use App\Freelancer;
use App\Empresa;
use App\Job;
use App\Item;
use App\Projeto;
use App\Avaliacoe;
use Auth;

use Illuminate\Http\Request;

class AvaliacaoController extends Controller
{
  public function __construct() {
    $this->middleware('auth:freelancer');
  }

  public function avaliarView(Projeto $projeto, Empresa $empresa) {
    $id = Auth::user()->id;
    $freelancer = Freelancer::find($id);
    $notificacoes = $freelancer->projetos()->where('aceito', '=', 0)->get();
    $notificacoes2 = $freelancer->grupos()->where('aceito', '=', 0)->get();

    $items = Item::where('destino', 'Freelancers')->orWhere('destino', 'Ambos')->get();

    return view('site.freelancer.avaliacao.avaliacao-view', compact('freelancer', 'notificacoes', 'notificacoes2', 'items', 'empresa', 'projeto'));
  }

  public function avaliar(Request $request) {
    $id = Auth::user()->id;
    $freelancer = Freelancer::find($id);
    $items = Item::where('destino', 'Freelancers')->orWhere('destino', 'Ambos')->get();
    $empresa = Empresa::find($request->idEmpresa);
    $total = 0;
    $media = 0;

    if (!$request->descritiva) {
      $descritiva = "Sem descrição.";
    } else {
      $descritiva = $request->descritiva;
    }

    foreach ($items as $item) {
      $create = Avaliacoe::create([
        'freelancer_avaliador' => Auth::user()->id,
        'empresa_avaliada' => $request->idEmpresa,
        'nota' => $request->get('item-'.$item->id),
        'descritiva' => $descritiva,
        'item_id' => $item->id
      ]);
      $total += $request->get('item-'.$item->id);
    }

    $media = $total / count($items);

    if($empresa->avaliacao_geral == 0) {
      $empresa->avaliacao_geral = $media;
      $empresa->save();
    }else {
      $empresa->avaliacao_geral = ($empresa->avaliacao_geral + $media)/2;
      $empresa->save();
    }

    $freelancer->projetos()->updateExistingPivot($request->idProjeto, ['avaliado_freela' => 1]);

    $pontuacaoId = 9;

    $empresa->pontuacoes()->attach($pontuacaoId, ['created_at' => new \DateTime(), 'updated_at' => new \DateTime()]);

    $message = $message = parent::returnMessage('success', 'Empresa avaliada com sucesso!');

    return redirect()->route('jobs.projeto.view')->with('message', $message);
  }
}
