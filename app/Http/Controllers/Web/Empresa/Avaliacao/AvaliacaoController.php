<?php

namespace App\Http\Controllers\Web\Empresa\Avaliacao;

use Auth;
use App\Avaliacoe;;
use App\Freelancer;
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
    return view('site.empresa.avaliacao.avaliacao-freelancer', compact('freelancer', 'items'));
  }

  public function avaliarFreelancer(Request $request) {
    $items = Item::all();
    foreach ($items as $item) {
      $create = Avaliacoe::create([
        'empresa_avaliadora' => Auth::user()->id,
        'freelancer_avaliado' => $request->idFreelancer,
        'nota' => $request->get('item-'.$item->id),,
        'descritiva' => request('descritiva'),
        'empresa_id' => Auth::user()->id,
        'item_id' => $item->id
      ]);
    }
  }
}
