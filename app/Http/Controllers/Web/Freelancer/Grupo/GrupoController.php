<?php

namespace App\Http\Controllers\Web\Freelancer\Grupo;

use App\Freelancer;
use App\Grupo;
use Auth;
use Illuminate\Http\Request;

class GrupoController extends Controller
{
  public function __construct() {
    $this->middleware('auth:freelancer');
  }

  public function gruposView() {
    $id = Auth::user()->id;
    $freelancer = Freelancer::find($id);
    $grupos = Grupo::orderBy('created_at', 'desc')->where('freelancer_id', $id)->get();
    $notificacoes = $freelancer->projetos()->where('aceito', '=', 0)->get();

    return view('site.freelancer.grupo.grupos-view', compact('freelancer', 'grupos', 'notificacoes'));
  }

  // Recebe um valor por POST e retorna somente os projetos correspondentes
  // public function projetosPesquisar(Request $request) {
  //   $id = Auth::user()->id;
  //   $empresa = Empresa::find($id);
  //   $projetos = Projeto::orWhere('titulo', 'like', '%' . $request->buscar . '%')->get();

  //   return view('site.empresa.projetos-view-pesquisar', compact('empresa', 'projetos'));
  // }

  // Carrega o formulário para cadastro do grupo
  public function novoGrupo() {
    $id = Auth::user()->id;
    $freelancer = Freelancer::find($id);
    $notificacoes = $freelancer->projetos()->where('aceito', '=', 0)->get();

    return view('site.freelancer.grupo.criar-grupo', compact('freelancer', 'notificacoes'));
  }

  public function criarGrupo() {
   $create = Grupo::create([
    'titulo' => request('titulo'),
    'descricao' => request('descricao'),
    'freelancer_id' => Auth::user()->id,
  ]);

   if ($create)
   {
    $message = parent::returnMessage('success', 'Grupo criado com sucesso!');
  } else
  {
    $message = parent::returnMessage('danger', 'Erro ao criar o grupo!');
  }

  return redirect('/freelancer/grupo/' . $create->id)->with('message', $message);
}

public function grupoView(Grupo $grupo) {
    $id = Auth::user()->id;
    $freelancer = Freelancer::find($id);
    $notificacoes = $freelancer->projetos()->where('aceito', '=', 0)->get();

    // $conhecimentos = Job::orderBy('status', 'asc')->orderBy('created_at', 'desc')->where('projeto_id', $projeto->id)->get();
    // $freelancers = $projeto->freelancers()->orderBy('nome')->get();
    // $produtoras = $projeto->empresas()->orderBy('nome')->get();
    $freelancers = [];
    $produtoras = [];
    $conhecimentos = [];

    return view('site.freelancer.grupo.grupo-view', compact('freelancer', 'grupo', 'conhecimentos', 'freelancers', 'produtoras', 'notificacoes'));
  }
}