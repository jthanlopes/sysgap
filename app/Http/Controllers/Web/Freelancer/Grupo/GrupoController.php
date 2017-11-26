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
    $grupos = Freelancer::find($id)->grupos()->where('status', 1)->whereIn('aceito', [0, 1])->get();
    $notificacoes = $freelancer->projetos()->where('aceito', '=', 0)->get();
    $notificacoes2 = $freelancer->grupos()->where('aceito', '=', 0)->get();

    return view('site.freelancer.grupo.grupos-view', compact('freelancer', 'grupos', 'notificacoes', 'notificacoes2'));
  }

  // Recebe um valor por POST e retorna somente os projetos correspondentes
  public function gruposPesquisar(Request $request) {
    $id = Auth::user()->id;
    $freelancer = Freelancer::find($id);
    $grupos = Freelancer::find($id)->grupos()->where([['status', 1], ['titulo', 'like', '%' . $request->buscar . '%']])->whereIn('aceito', [0, 1])->get();
    $notificacoes = $freelancer->projetos()->where('aceito', '=', 0)->get();
    $notificacoes2 = $freelancer->grupos()->where('aceito', '=', 0)->get();

    return view('site.freelancer.grupo.grupos-view-pesquisar', compact('freelancer', 'grupos', 'notificacoes', 'notificacoes2'));
  }

  // Carrega o formulário para cadastro do grupo
  public function novoGrupo() {
    $id = Auth::user()->id;
    $freelancer = Freelancer::find($id);
    $notificacoes = $freelancer->projetos()->where('aceito', '=', 0)->get();
    $notificacoes2 = $freelancer->grupos()->where('aceito', '=', 0)->get();

    return view('site.freelancer.grupo.criar-grupo', compact('freelancer', 'notificacoes', 'notificacoes2'));
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

  $create->freelancers()->attach($freelancer, ['created_at' => new \DateTime(), 'updated_at' => new \DateTime(), 'aceito' => 1]);

  return redirect('/freelancer/grupo/' . $create->id)->with('message', $message);
}

public function grupoView(Grupo $grupo) {
  $id = Auth::user()->id;
  $freelancer = Freelancer::find($id);
  $notificacoes = $freelancer->projetos()->where('aceito', '=', 0)->get();
  $notificacoes2 = $freelancer->grupos()->where('aceito', '=', 0)->get();
  $results = $grupo->freelancers()->orderBy('created_at')->get();
  $conhecimentos = [];

  return view('site.freelancer.grupo.grupo-view', compact('freelancer', 'grupo', 'conhecimentos', 'results', 'notificacoes', 'notificacoes2'));
}

public function fecharGrupo(Grupo $grupo) {
  $grupo->status = 0;
  $grupo->save();

  $message = parent::returnMessage('success', 'Grupo fechado com sucesso!');

  return redirect()->route('grupos.view')->with('message', $message);
}

public function editarGrupoView(Grupo $grupo) {
  $id = Auth::user()->id;
  $freelancer = Freelancer::find($id);
  $notificacoes = $freelancer->projetos()->where('aceito', '=', 0)->get();
  $notificacoes2 = $freelancer->grupos()->where('aceito', '=', 0)->get();

  return view('site.freelancer.grupo.grupo-editar', compact('grupo', 'freelancer', 'notificacoes', 'notificacoes2'));
}

public function editarGrupo(Request $request) {
  $update = Grupo::where('id', $request->grupo)
  ->update(['titulo' => request('titulo'),
    'descricao' => request('descricao'),
    'freelancer_id' => Auth::user()->id,
    'status' => 1,
  ]);

  if ($update)
  {
    $message = parent::returnMessage('success', 'Grupo editado com sucesso!');
  } else
  {
    $message = parent::returnMessage('danger', 'Erro ao editar o grupo!');
  }

  return redirect('/freelancer/grupo/' . $request->grupo)->with('message', $message);
}

public function novoFormIntegrantes(Grupo $grupo) {
  $id = Auth::user()->id;
  $freelancer = Freelancer::find($id);
  $results = Freelancer::where('id', '!=', $id)->orderBy('nome')->paginate(20);
  $notificacoes = $freelancer->projetos()->where('aceito', '=', 0)->get();
  $notificacoes2 = $freelancer->grupos()->where('aceito', '=', 0)->get();

  return view('site.freelancer.integrante.add-integrante', compact('grupo', 'freelancer', 'notificacoes', 'results', 'notificacoes2'));
}

public function addFreelancer(Grupo $grupo, Freelancer $freelancer) {
 $grupo->freelancers()->attach($freelancer, ['created_at' => new \DateTime(), 'updated_at' => new \DateTime(), 'aceito' => 0]);

 $message = parent::returnMessage('success', 'O freelancer foi convidado para o grupo!');

 return redirect('/freelancer/grupo/' . $grupo->id)->with('message', $message);
}

public function removerFreelancer(Grupo $grupo, Freelancer $freelancer) {
  $grupo->freelancers()->detach($freelancer);

  $message = parent::returnMessage('success', $freelancer->nome . ' foi removido(a) do grupo!');

  return redirect('/freelancer/grupo/' . $grupo->id)->with('message', $message);
}

public function aceitarGrupo(Grupo $grupo) {
  $id = Auth::user()->id;
  $freelancer = Freelancer::find($id);
  $freelancer->grupos()->updateExistingPivot($grupo->id, ['aceito' => 1]);

  $message = parent::returnMessage('success', 'Você aceitou o convite. Bem-vindo ao grupo!');

  return redirect('/freelancer/grupo/' . $grupo->id)->with('message', $message);
}

public function recusarGrupo(Grupo $grupo) {
  $id = Auth::user()->id;
  $freelancer = Freelancer::find($id);
  $freelancer->grupos()->updateExistingPivot($grupo->id, ['aceito' => 3]);

  $message = parent::returnMessage('success', 'Você recusou o convite!');

  return redirect()->route('grupos.view')->with('message', $message);
}
}