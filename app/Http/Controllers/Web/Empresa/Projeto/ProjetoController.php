<?php

namespace App\Http\Controllers\Web\Empresa\Projeto;

use App\Projeto;
use App\Freelancer;
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
    $projetos = Projeto::orderBy('created_at', 'desc')->where('empresa_id', $id)->get();

    return view('site.empresa.projetos-view', compact('empresa', 'projetos'));
  }

  // Recebe um valor por POST e retorna somente os projetos correspondentes
  public function projetosPesquisar(Request $request) {
    $id = Auth::user()->id;
    $empresa = Empresa::find($id);    
    $projetos = Projeto::orWhere('titulo', 'like', '%' . $request->buscar . '%')->get();

    return view('site.empresa.projetos-view-pesquisar', compact('empresa', 'projetos'));
  }

  public function viewProjeto(Projeto $projeto) {
    $id = Auth::user()->id;
    $empresa = Empresa::find($id);
    $jobs = Job::orderBy('status', 'asc')->orderBy('created_at', 'desc')->where('projeto_id', $projeto->id)->get();

    $freelancers = $projeto->freelancers()->orderBy('nome')->get();
    
    return view('site.empresa.projeto-view', compact('empresa', 'projeto', 'jobs', 'freelancers'));
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

public function novoFormIntegrantes(Projeto $projeto) {
  $id = Auth::user()->id;
  $empresa = Empresa::find($id);
  $results = Freelancer::all();

  return view('site.empresa.integrante.add-integrante', compact('empresa', 'projeto', 'results'));
}

public function pesquisarIntegrantes(Projeto $projeto, Request $request) {
  $categoria = $request->get('categoria');
  $id = Auth::user()->id;
  $empresa = Empresa::find($id);

  if ($categoria == 0) {
    $results = Freelancer::orWhere('nome', 'like', '%' . $request->nome . '%')->get();
    
    return view('site.empresa.integrante.add-integrante', compact('empresa', 'projeto', 'results'));
  } else {
    $results = Empresa::orWhere('nome', 'like', '%' . $request->nome . '%')
    ->where('categoria', 'Produtora')->get();
    $categoria = "produtora";
  }

  return view('site.empresa.integrante.add-integrante-produtora', compact('empresa', 'projeto', 'results'));
}

public function addFreelancer(Projeto $projeto, Freelancer $freelancer) {
  $projeto->freelancers()->attach($freelancer, ['created_at' => new \DateTime(), 'updated_at' => new \DateTime(), 'tempo_experiencia' => 0]);  

  $message = parent::returnMessage('success', $freelancer->nome . ' foi adicionado(a) ao projeto "' . $projeto->titulo .'"!');

  return redirect('/empresa/projeto/' . $projeto->id)->with('message', $message);
}

public function addProdutora(Projeto $projeto, Empresa $empresa) {
  $projeto->freelancers()->attach($empresa);

  $message = parent::returnMessage('success', $empresa->nome . ' foi adicionado(a) ao projeto "' . $projeto->titulo . '"!');

  return redirect('/empresa/projeto/' . $projeto->id)->with('message', $message);
}

public function removerFreelancer(Projeto $projeto, Freelancer $freelancer) {
  $projeto->freelancers()->detach($freelancer);

  $message = parent::returnMessage('success', $freelancer->nome . ' foi removido(a) do projeto "' . $projeto->titulo .'"!');

  return redirect('/empresa/projeto/' . $projeto->id)->with('message', $message);
}
}