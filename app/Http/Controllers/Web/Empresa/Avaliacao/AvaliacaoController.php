<?php

namespace App\Http\Controllers\Web\Empresa\Avaliacao;

use Auth;
use App\Avaliacoe;;
use App\Freelancer;
use App\Empresa;
use App\Projeto;
use App\Item;
use Illuminate\Http\Request;

class AvaliacaoController extends Controller
{
  public function __construct() {
    $this->middleware('auth:empresa');
  }

  public function avaliarFreelancerView(Projeto $projeto, Freelancer $freelancer) {
    $items = Item::all();
    return view('site.empresa.avaliacao.avaliacao-freelancer', compact('freelancer', 'items', 'projeto'));
  }

  public function avaliarFreelancer(Request $request) {
    $items = Item::all();
    $freelancer = Freelancer::find($request->idFreelancer);

    if (!$request->descritiva) {
      $descritiva = "Sem descrição.";
    } else {
      $descritiva = $request->descritiva;
    }

    foreach ($items as $item) {
      $create = Avaliacoe::create([
        'empresa_avaliadora' => Auth::user()->id,
        'freelancer_avaliado' => $request->idFreelancer,
        'nota' => $request->get('item-'.$item->id),
        'descritiva' => $descritiva,
        'item_id' => $item->id
      ]);
    }

    $freelancer->projetos()->updateExistingPivot($request->idProjeto, ['avaliado' => 1]);

    $message = $message = parent::returnMessage('success', 'Freelancer avaliado com sucesso!');

    return redirect('/empresa/projeto/' . $request->idProjeto . '/finalizar')->with('message', $message);
  }

   public function avaliarProdutoraView(Projeto $projeto, Empresa $produtora) {
    $items = Item::all();
    return view('site.empresa.avaliacao.avaliacao-produtora', compact('produtora', 'items', 'projeto'));
  }

  public function avaliarProdutora(Request $request) {
    $items = Item::all();
    $empresa = Empresa::find($request->idProdutora);

    if (!$request->descritiva) {
      $descritiva = "Sem descrição.";
    } else {
      $descritiva = $request->descritiva;
    }

    foreach ($items as $item) {
      $create = Avaliacoe::create([
        'empresa_avaliadora' => Auth::user()->id,
        'empresa_avaliada' => $request->idProdutora,
        'nota' => $request->get('item-'.$item->id),
        'descritiva' => $descritiva,
        'item_id' => $item->id
      ]);
    }

    $empresa->projetos()->updateExistingPivot($request->idProjeto, ['avaliado' => 1]);

    $message = $message = parent::returnMessage('success', 'Produtora avaliada com sucesso!');

    return redirect('/empresa/projeto/' . $request->idProjeto . '/finalizar')->with('message', $message);
  }
}
