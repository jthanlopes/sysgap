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
    $projetosAbertos = Projeto::orderBy('created_at', 'desc')->where([['empresa_id', $id], ['status', 'Aberto']])->get();
    $projetosCancelados = Projeto::orderBy('created_at', 'desc')->where([['empresa_id', $id], ['status', 'Cancelado']])->get();
    $projetosFinalizados = Projeto::orderBy('created_at', 'desc')->where([['empresa_id', $id], ['status', 'Finalizado']])->get();
    $notificacoes = $empresa->projetos()->where('aceito', '=', 0)->get();

    return view('site.empresa.projetos-view', compact('empresa', 'projetosAbertos', 'notificacoes', 'projetosFinalizados', 'projetosCancelados'));
  }

  // Recebe um valor por POST e retorna somente os projetos correspondentes
  public function projetosPesquisar(Request $request) {
    $id = Auth::user()->id;
    $empresa = Empresa::find($id);
    $projetos = Projeto::orWhere('titulo', 'like', '%' . $request->buscar . '%')->get();
    $notificacoes = $empresa->projetos()->where('aceito', '=', 0)->get();

    return view('site.empresa.projetos-view-pesquisar', compact('empresa', 'projetos', 'notificacoes'));
  }

  public function viewProjeto(Projeto $projeto) {
    $id = Auth::user()->id;
    $empresa = Empresa::find($id);
    $notificacoes = $empresa->projetos()->where('aceito', '=', 0)->get();

    $jobs = Job::orderBy('status', 'asc')->orderBy('created_at', 'desc')->where('projeto_id', $projeto->id)->get();

    $freelancers = $projeto->freelancers()->orderBy('nome')->get();
    $produtoras = $projeto->empresas()->orderBy('nome')->get();

    return view('site.empresa.projeto-view', compact('empresa', 'projeto', 'jobs', 'freelancers', 'produtoras', 'notificacoes'));
  }

  // Carrega o formulário para cadastro do projeto
  public function novoProjeto() {
    $id = Auth::user()->id;
    $empresa = Empresa::find($id);
    $notificacoes = $empresa->projetos()->where('aceito', '=', 0)->get();

    return view('site.empresa.criar-projeto', compact('empresa', 'notificacoes'));
  }

  public function criarProjeto() {
    $id = Auth::user()->id;
    $empresa = Empresa::find($id);
    $create = Projeto::create([
      'titulo' => request('titulo'),
      'descricao' => request('descricao'),
      'status' => 'Aberto',
      'empresa_id' => Auth::user()->id,
    ]);

    if ($create)
    {
      $message = parent::returnMessage('success', 'Projeto criado com sucesso!');

      $verificaPontuacao = $empresa->pontuacoes()->where('pontuacoe_id', 7)->count();

      if($verificaPontuacao == 0) {
        $pontuacaoId = 7;

        $empresa->pontuacoes()->attach($pontuacaoId, ['created_at' => new \DateTime(), 'updated_at' => new \DateTime()]);
      }

    } else
    {
      $message = parent::returnMessage('danger', 'Erro ao criar o projeto!');
    }

    return redirect('/empresa/projeto/' . $create->id)->with('message', $message);
  }

  public function editarProjetoView(Projeto $projeto) {
    $id = Auth::user()->id;
    $empresa = Empresa::find($id);
    $notificacoes = $empresa->projetos()->where('aceito', '=', 0)->get();

    return view('site.empresa.projeto-editar', compact('empresa', 'projeto', 'notificacoes'));
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
    $notificacoes = $empresa->projetos()->where('aceito', '=', 0)->get();

    return view('site.empresa.integrante.add-integrante', compact('empresa', 'projeto', 'results', 'notificacoes'));
  }

  public function pesquisarIntegrantes(Projeto $projeto, Request $request) {
    $categoria = $request->get('categoria');
    $id = Auth::user()->id;
    $empresa = Empresa::find($id);
    $notificacoes = $empresa->projetos()->where('aceito', '=', 0)->get();

    if ($categoria == 0) {
      $results = Freelancer::where('nome', 'like', '%' . $request->nome . '%')->orWhere('email', 'like', '%' . $request->nome . '%')->get();

      return view('site.empresa.integrante.add-integrante', compact('empresa', 'projeto', 'results', 'notificacoes'));
    } else {
      $results = Empresa::where([['id', '!=', $id], ['nome', 'like', '%' . $request->nome . '%'], ['categoria', 'Produtora']])->orWhere([['id', '!=', $id] ,['email', 'like', '%' . $request->nome . '%'], ['categoria', 'Produtora']])->get();

      $categoria = "produtora";
    }

    return view('site.empresa.integrante.add-integrante-produtora', compact('empresa', 'projeto', 'results', 'notificacoes'));
  }

  public function addFreelancer(Projeto $projeto, Freelancer $freelancer) {
    $projeto->freelancers()->attach($freelancer, ['created_at' => new \DateTime(), 'updated_at' => new \DateTime(), 'aceito' => 0, 'avaliado' => 0, 'avaliado_freela' => 0]);

    $message = parent::returnMessage('success', $freelancer->nome . ' foi convidado(a) para o projeto!');

    return redirect('/empresa/projeto/' . $projeto->id)->with('message', $message);
  }

  public function addProdutora(Projeto $projeto, Empresa $empresa) {
    $projeto->empresas()->attach($empresa, ['created_at' => new \DateTime(), 'updated_at' => new \DateTime(), 'aceito' => 0, 'avaliado' => 0, 'avaliado_prod' => 0]);

    $message = parent::returnMessage('success', $empresa->nome . ' foi convidado(a) para o projeto!');

    return redirect('/empresa/projeto/' . $projeto->id)->with('message', $message);
  }

  public function removerFreelancer(Projeto $projeto, Freelancer $freelancer) {
    $projeto->freelancers()->detach($freelancer);

    $message = parent::returnMessage('success', $freelancer->nome . ' foi removido(a) do projeto "' . $projeto->titulo .'"!');

    return redirect('/empresa/projeto/' . $projeto->id)->with('message', $message);
  }

  public function removerProdutora(Projeto $projeto, Empresa $empresa) {
    $projeto->empresas()->detach($empresa);

    $message = parent::returnMessage('success', $empresa->nome . ' foi removido(a) do projeto "' . $projeto->titulo .'"!');

    return redirect('/empresa/projeto/' . $projeto->id)->with('message', $message);
  }

  public function finalizarProjetoView(Projeto $projeto) {
    $id = Auth::user()->id;
    $empresa = Empresa::find($id);
    $notificacoes = $empresa->projetos()->where('aceito', '=', 0)->get();
    $freelancers = Projeto::find($projeto->id)->freelancers;
    $produtoras = Projeto::find($projeto->id)->empresas;
    $controle = 0;

    if (count($freelancers) == 0 && count($produtoras) == 0) {
      $message = parent::returnMessage('info', 'Para ser finalizado, o projeto deve ter no minímo um integrante!');

     return redirect()->route('projetos.view')->with('message', $message);
   }

   foreach ($freelancers as $freelancer) {
    foreach ($freelancer->projetos as $freelaProjeto) {
      if ($freelaProjeto->id == $projeto->id && $freelaProjeto->pivot->avaliado == 0) {
        $controle++;
      }
    }
  }

  foreach ($produtoras as $produtora) {
    foreach ($produtora->projetos as $prodProjeto) {
      if ($prodProjeto->id == $projeto->id && $prodProjeto->pivot->avaliado == 0) {
        $controle++;
      }
    }
  }

  if ($controle == 0) {
    $projeto->status = "Finalizado";
    $projeto->save();

    $jobs = $projeto->jobs;

    foreach ($jobs as $job) {
      $job->status = "Finalizado";
      $job->save();
    }

    $message = parent::returnMessage('success', 'O projeto foi finalizado!');

    return redirect()->route('projetos.view')->with('message', $message);
  }

  return view('site.empresa.projeto-view-finalizar', compact('projeto', 'freelancers', 'produtoras', 'notificacoes'));
}

public function cancelarProjeto(Projeto $projeto) {
  $projeto->status = "Cancelado";
  $projeto->save();

  $message = parent::returnMessage('success', 'O projeto foi cancelado!');

  return redirect()->route('projetos.view')->with('message', $message);
}

public function reabrirProjeto(Projeto $projeto) {
  $projeto->status = "Aberto";
  $projeto->save();

  $message = parent::returnMessage('success', 'O projeto foi reaberto!');

  return redirect()->back()->with('message', $message);
}
}