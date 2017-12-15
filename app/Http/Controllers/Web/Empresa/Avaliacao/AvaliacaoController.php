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
    $items = Item::where('destino', 'Empresas')->orWhere('destino', 'Ambos')->get();
    $id = Auth::user()->id;
    $empresa = Empresa::find($id);
    $notificacoes = $empresa->projetos()->where('aceito', '=', 0)->get();

    return view('site.empresa.avaliacao.avaliacao-freelancer', compact('freelancer', 'items', 'projeto', 'notificacoes'));
  }

  public function avaliarFreelancer(Request $request) {
    $items = Item::where('destino', 'Empresas')->orWhere('destino', 'Ambos')->get();
    $freelancer = Freelancer::find($request->idFreelancer);
    $total = 0;
    $media = 0;

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
      $total += $request->get('item-'.$item->id);
    }

    $media = $total / count($items);

    if($freelancer->avaliacao_geral == 0) {
      $freelancer->avaliacao_geral = $media;
      $freelancer->save();
    }else {
      $freelancer->avaliacao_geral = ($freelancer->avaliacao_geral + $media)/2;
      $freelancer->save();
    }

    $freelancer->projetos()->updateExistingPivot($request->idProjeto, ['avaliado' => 1]);

    $pontuacaoId = 9;

    $freelancer->pontuacoes()->attach($pontuacaoId, ['created_at' => new \DateTime(), 'updated_at' => new \DateTime()]);

    $message = $message = parent::returnMessage('success', 'Freelancer avaliado com sucesso!');

    return redirect('/empresa/projeto/' . $request->idProjeto . '/finalizar')->with('message', $message);
  }

  public function avaliarProdutoraView(Projeto $projeto, Empresa $produtora) {
    $items = Item::where('destino', 'Empresas')->orWhere('destino', 'Ambos')->get();
    $id = Auth::user()->id;
    $empresa = Empresa::find($id);
    $notificacoes = $empresa->projetos()->where('aceito', '=', 0)->get();

    return view('site.empresa.avaliacao.avaliacao-produtora', compact('produtora', 'items', 'projeto', 'notificacoes'));
  }

  public function avaliarProdutora(Request $request) {
    $items = Item::where('destino', 'Empresas')->orWhere('destino', 'Ambos')->get();
    $empresa = Empresa::find($request->idProdutora);
    $total = 0;
    $media = 0;

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

    $empresa->projetos()->updateExistingPivot($request->idProjeto, ['avaliado' => 1]);

    $pontuacaoId = 9;

    $empresa->pontuacoes()->attach($pontuacaoId, ['created_at' => new \DateTime(), 'updated_at' => new \DateTime()]);

    $message = $message = parent::returnMessage('success', 'Produtora avaliada com sucesso!');

    return redirect('/empresa/projeto/' . $request->idProjeto . '/finalizar')->with('message', $message);
  }

  public function avaliacoesFeitasView() {
    $id = Auth::user()->id;
    $empresa = Empresa::find($id);
    $notificacoes = $empresa->projetos()->where('aceito', '=', 0)->get();
    $avaliacoesFreelas = Avaliacoe::where([['empresa_avaliadora', $id], ['freelancer_avaliado', '<>', null]])->get();
    $avaliacoesProd = Avaliacoe::where([['empresa_avaliadora', $id], ['empresa_avaliada', '<>', null]])->get();

    return view('site.empresa.avaliacao.avaliacoes-feitas', compact('notificacoes', 'avaliacoesFreelas', 'avaliacoesProd'));
  }

  public function avaliacoesRecebidasView() {
    $id = Auth::user()->id;
    $empresa = Empresa::find($id);
    $notificacoes = $empresa->projetos()->where('aceito', '=', 0)->get();
    $avaliacoes = Avaliacoe::where('empresa_avaliada', $id);

    return view('site.empresa.avaliacao.avaliacoes-recebidas', compact('notificacoes', 'avaliacoes'));
  }
}
