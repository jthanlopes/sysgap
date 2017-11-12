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
    $grupos = Freelancer::find($id)->grupos()->where('status', 1)->get();
    $notificacoes = $freelancer->projetos()->where('aceito', '=', 0)->get();

    return view('site.freelancer.grupo.grupos-view', compact('freelancer', 'grupos', 'notificacoes'));
  }

  // Recebe um valor por POST e retorna somente os projetos correspondentes
  public function gruposPesquisar(Request $request) {
    $id = Auth::user()->id;
    $freelancer = Freelancer::find($id);
    $grupos = Freelancer::find($id)->grupos()->where([['status', 1], ['titulo', 'like', '%' . $request->buscar . '%']])->get();
    $notificacoes = $freelancer->projetos()->where('aceito', '=', 0)->get();

    return view('site.freelancer.grupo.grupos-view-pesquisar', compact('freelancer', 'grupos', 'notificacoes'));
  }

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
    'status' => 1,
  ]);

   if ($create)
   {
    $message = parent::returnMessage('success', 'Grupo criado com sucesso!');
  } else
  {
    $message = parent::returnMessage('danger', 'Erro ao criar o grupo!');
  }

  $id = Auth::user()->id;
  $freelancer = Freelancer::find($id);

  $create->freelancers()->attach($freelancer, ['created_at' => new \DateTime(), 'updated_at' => new \DateTime()]);

  return redirect('/freelancer/grupo/' . $create->id)->with('message', $message);
}

public function grupoView(Grupo $grupo) {
  $id = Auth::user()->id;
  $freelancer = Freelancer::find($id);
  $notificacoes = $freelancer->projetos()->where('aceito', '=', 0)->get();
  $freelancers = $grupo->freelancers()->orderBy('nome')->get();
  $produtoras = [];
  $conhecimentos = [];

  return view('site.freelancer.grupo.grupo-view', compact('freelancer', 'grupo', 'conhecimentos', 'freelancers', 'notificacoes'));
}

public function fecharGrupo(Grupo $grupo) {
  $grupo->status = 0;
  $grupo->save();

  $message = parent::returnMessage('success', 'Grupo fechado com sucesso!');

  return redirect()->route('grupos.view')->with('message', $message);
}
}