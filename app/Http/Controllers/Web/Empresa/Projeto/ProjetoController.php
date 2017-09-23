<?php

namespace App\Http\Controllers\Web\Empresa\Projeto;

use App\Projeto;
use App\Empresa;
use Auth;
use Illuminate\Http\Request;

class ProjetoController extends Controller
{
  public function __construct() {
    $this->middleware('auth:empresa');
  }

  public function novoProjeto() {
    $id = Auth::user()->id;
    $empresa = Empresa::find($id);
    return view('site.empresa.criar-projeto', compact('empresa'));
  }

  public function criarProjeto() {
   $create = Projeto::create([
    'titulo' => request('titulo'),
    'descricao' => request('descricao'),
    'status' => 'Aberto',
    'empresa_id' => Auth::user()->id,
  ]);

   if ($create)
   {
    $message = parent::returnMessage('success', 'Projeto criado com sucesso!');
  } else 
  {
    $message = parent::returnMessage('danger', 'Erro ao criar o projeto!');
  }

  return redirect()->route('projeto.show-form-novo')->with('message', $message);
}
}
