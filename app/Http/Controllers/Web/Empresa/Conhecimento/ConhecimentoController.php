<?php

namespace App\Http\Controllers\Web\Empresa\Conhecimento;

use App\Conhecimento;
use App\Empresa;
use Auth;

use Illuminate\Http\Request;

class ConhecimentoController extends Controller
{
  public function __construct() {
    $this->middleware('auth:empresa');
  }

  public function conhecimentosView() {
    $id = Auth::user()->id;
    $empresa = Empresa::find($id);
    $conhecimentos = Conhecimento::orderBy('titulo')->get();

    return view('site.empresa.conhecimentos-view', compact('empresa', 'conhecimentos'));
  }

  public function addConhecimento(Request $request) {
    $id = $request->get('tecnologia');
    $conhecimento = Conhecimento::find($id);
    $empresa = Auth::user();
    $add = $empresa->conhecimentos()->attach($conhecimento);

    $message = parent::returnMessage('success', 'Conhecimento adicionado com sucesso!');

    return redirect()->route('tecnologias.view')->with('message', $message);
  }

  public function excluirConhecimento(Conhecimento $conhecimento) {
    $empresa = Auth::user();
    $empresa->conhecimentos()->detach($conhecimento);

    $message = parent::returnMessage('success', 'Conhecimento removido com sucesso!');

    return redirect()->route('tecnologias.view')->with('message', $message);
  }
}
