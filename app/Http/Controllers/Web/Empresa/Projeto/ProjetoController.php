<?php

namespace App\Http\Controllers\Web\Empresa\Projeto;

use App\Projeto;
use App\Empresa;
use App\Job;
use Auth;
use Illuminate\Http\Request;

class ProjetoController extends Controller
{  
  public function __construct() {    
    $this->middleware('auth:empresa');
  }

  public function projetosView() {
    $id = Auth::user()->id;
    $empresa = Empresa::find($id);
    $projetos = Projeto::all()->where('empresa_id', $id);

    return view('site.empresa.projetos-view', compact('empresa', 'projetos'));
  }

  public function projetosPesquisar(Request $request) {
    $id = Auth::user()->id;
    $empresa = Empresa::find($id);    
    $projetos = Projeto::orWhere('titulo', 'like', '%' . $request->buscar . '%')->get();

    return view('site.empresa.projetos-view-pesquisar', compact('empresa', 'projetos'));
  }

  public function viewProjeto(Projeto $projeto) {
    $id = Auth::user()->id;
    $empresa = Empresa::find($id);
    $jobs = Job::all()->where('projeto_id', $projeto->id);

    return view('site.empresa.projeto-view', compact('empresa', 'projeto', 'jobs'));
  }

  // Carrega o formulário para cadastro do projeto
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

  return redirect()->route('projetos.view')->with('message', $message);
}

public function editarProjetoView(Projeto $projeto) {
      $id = Auth::user()->id;
      $empresa = Empresa::find($id);

      return view('site.empresa.projeto-editar', compact('empresa', 'projeto'));
    }

    public function editarProjeto() {      
      $update = Projeto::where( 'id', request('idProjeto') )
                                  ->update([
                                      'titulo' => request('titulo'),
                                      'descricao' => request('descricao'),
                                      'status' => 'Aberto',
                                      'empresa_id' => Auth::user()->id,
                                  ]);
      
      if ($update)
     {
      $message = parent::returnMessage('success', 'Projeto alterado com sucesso!');
    } else 
    {
      $message = parent::returnMessage('danger', 'Erro ao alterar o projeto!');
    }      

      return redirect('/empresa/projeto/' . request('idProjeto'))->with('message', $message);
    }
  }