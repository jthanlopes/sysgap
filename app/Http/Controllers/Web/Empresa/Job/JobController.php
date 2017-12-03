<?php

namespace App\Http\Controllers\Web\Empresa\Job;

use App\Job;
use App\Projeto;
use App\Empresa;
use App\Freelancer;
use App\Conhecimento;
use Carbon\Carbon;

use Auth;
use Illuminate\Http\Request;

class JobController extends Controller
{
  public function __construct() {
    $this->middleware('auth:empresa');
     Carbon::setLocale('pt-br');
  }

  public function jobView(Projeto $projeto, Job $job) {
    $id = Auth::user()->id;
    $empresa = Empresa::find($id);
    $freelancers = $job->freelancers()->orderBy('nome')->get();
    $produtoras = $job->empresas()->orderBy('nome')->get();
    $jobConhe = $job->conhecimentos()->select('id')->get()->pluck('id')->toArray();
    $conhecimentos = Conhecimento::orderBy('titulo')->wherenotin('id', $jobConhe)->get();
    $notificacoes = $empresa->projetos()->where('aceito', '=', 0)->get();
    $comentarios = Job::find($job->id)->comentarios()->orderBy('created_at', 'DESC')->paginate(10);

    return view('site.empresa.job.job-view', compact('empresa', 'job', 'projeto', 'freelancers', 'produtoras','conhecimentos', 'notificacoes', 'comentarios'));
  }

  public function novoForm(Projeto $projeto) {
    $id = Auth::user()->id;
    $empresa = Empresa::find($id);
    $notificacoes = $empresa->projetos()->where('aceito', '=', 0)->get();

    return view('site.empresa.job.criar-job', compact('empresa', 'projeto', 'notificacoes'));
  }

  public function novo(Request $request) {
    auth()->guard('empresa')->user()->cadastrarJob(
      $job = new Job(['titulo' => $request->titulo, 'descricao' => $request->descricao,
        'nivel_conhecimento_necessario' => $request->get('nivel'), 'status' => 'Aberto', 'projeto_id' => $request->projeto])
    );

    $message = parent::returnMessage('success', 'Job cadastrado com sucesso!');

    return redirect('/empresa/projeto/' . $request->projeto . '/job/' . $job->id)->with('message', $message);
  }

  public function editarJobView(Projeto $projeto, Job $job) {
    $id = Auth::user()->id;
    $empresa = Empresa::find($id);
    $notificacoes = $empresa->projetos()->where('aceito', '=', 0)->get();

    return view('site.empresa.job.editar-job', compact('empresa', 'job', 'notificacoes'));
  }

  public function editarJob(Request $request) {
    $update = Job::where( 'id', $request->job )
    ->update([
      'titulo' => $request->titulo,
      'descricao' => $request->descricao,
      'nivel_conhecimento_necessario' => $request->get('nivel'),
      'status' => 'Aberto',
      'projeto_id' => $request->projeto,
      'empresa_id' => $request->empresa,
    ]);

    if ( $update )
    {
      $message = parent::returnMessage('success', 'Alteração efetuada com sucesso!');
    } else
    {
      $message = parent::returnMessage('danger', 'Erro ao efetuar a alteração!');
    }

    $projeto = $request->projeto;
    $job = $request->job;

    return redirect('/empresa/projeto/' . $projeto .'/job/' . $job)->with('message', $message);
  }

  public function finalizarJob(Projeto $projeto, Job $job) {
    $job->status = "Finalizado";
    $job->save();

    $message = parent::returnMessage('success', 'Job finalizado com sucesso!');

    return redirect()->back()->with('message', $message);
  }

  public function reabrirJob(Projeto $projeto, Job $job) {
    $job->status = "Aberto";
    $job->save();

    $message = parent::returnMessage('success', 'Job reaberto com sucesso!');

    return redirect()->back()->with('message', $message);
  }

  public function novoFormIntegrantes(Projeto $projeto, Job $job) {
    $id = Auth::user()->id;
    $empresa = Empresa::find($id);
    $freelancers = $projeto->freelancers()->where('aceito', '=', 1)->orderBy('nome')->get();
    $produtoras = $projeto->empresas()->where('aceito', '=', 1)->orderBy('nome')->get();
    $notificacoes = $empresa->projetos()->where('aceito', '=', 0)->get();

    return view('site.empresa.integrante.add-integrante-job', compact('empresa', 'projeto', 'freelancers', 'produtoras', 'job', 'notificacoes'));
  }

  public function addFreelancer(Projeto $projeto, Job $job, Freelancer $freelancer) {
    $job->freelancers()->attach($freelancer, ['created_at' => new \DateTime(), 'updated_at' => new \DateTime()]);

    $message = parent::returnMessage('success', $freelancer->nome . ' foi adicionado(a) a este job!');

    return redirect('/empresa/projeto/' . $projeto->id . '/job/' . $job->id)->with('message', $message);
  }

  public function removerFreelancer(Projeto $projeto, Job $job, Freelancer $freelancer) {
    $job->freelancers()->detach($freelancer);

    $message = parent::returnMessage('success', $freelancer->nome . ' foi removido(a) do job!');

    return redirect('/empresa/projeto/' . $projeto->id . '/job/' . $job->id)->with('message', $message);
  }

  public function addProdutora(Projeto $projeto, Job $job, Empresa $empresa) {
    $job->empresas()->attach($empresa, ['created_at' => new \DateTime(), 'updated_at' => new \DateTime()]);

    $message = parent::returnMessage('success', $empresa->nome . ' foi adicionado(a) a este job!');

    return redirect('/empresa/projeto/' . $projeto->id . '/job/' . $job->id)->with('message', $message);
  }

  public function removerProdutora(Projeto $projeto, Job $job, Empresa $empresa) {
    $job->empresas()->detach($empresa);

    $message = parent::returnMessage('success', $empresa->nome . ' foi removido(a) do job!');

    return redirect('/empresa/projeto/' . $projeto->id . '/job/' . $job->id)->with('message', $message);
  }

  public function addConhecimento(Projeto $projeto, Job $job, Request $request) {
    $id = $request->get('tecnologia');
    $conhecimento = Conhecimento::find($id);
    $add = $job->conhecimentos()->attach($conhecimento, ['created_at' => new \DateTime(), 'updated_at' => new \DateTime()]);

    $message = parent::returnMessage('success', 'Conhecimento adicionado com sucesso!');

    return redirect()->back()->with('message', $message);
  }

  public function removerConhecimento(Projeto $projeto, Job $job, Conhecimento $conhecimento) {
    $job->conhecimentos()->detach($conhecimento);

    $message = parent::returnMessage('success', 'Conhecimento removido com sucesso!');

    return redirect()->back()->with('message', $message);
  }

  public function jobsView(Projeto $projeto) {
    $id = Auth::user()->id;
    $empresa = Empresa::find($id);
    $notificacoes = $empresa->projetos()->where('aceito', '=', 0)->get();

    if($projeto->titulo == null) {
      $jobs = Empresa::find($id)->jobsProd()->where([['status', 'Aberto']])->paginate(10);
    } else {
      $jobs = Empresa::find($id)->jobsProd()->where([['projeto_id', $projeto->id], ['status', 'Aberto']])->paginate(10);
    }

    return view('site.empresa.job.jobs-view', compact('empresa', 'jobs', 'notificacoes'));
  }

  public function jobsViewProjeto() {
    $id = Auth::user()->id;
    $empresa = Empresa::find($id);
    $projetos = Empresa::find($id)->projetos()->where('aceito', '!=', 3)->get();
    $notificacoes = $empresa->projetos()->where('aceito', '=', 0)->get();

    return view('site.empresa.job.jobs-view-projeto', compact('empresa', 'projetos', 'notificacoes'));
  }

  public function aceitarProjeto(Projeto $projeto) {
    $id = Auth::user()->id;
    $empresa = Empresa::find($id);
    $empresa->projetos()->updateExistingPivot($projeto->id, ['aceito' => 1]);

    $message = parent::returnMessage('success', 'Você aceitou o convite. Bem-vindo ao projeto!');

    return redirect('/empresa/jobs-projetos/' . $projeto->id)->with('message', $message);
  }

  public function recusarProjeto(Projeto $projeto) {
    $id = Auth::user()->id;
    $empresa = Empresa::find($id);
    $empresa->projetos()->updateExistingPivot($projeto->id, ['aceito' => 3]);

    $message = parent::returnMessage('success', 'Você recusou o convite!');

    return redirect()->route('jobs-projeto.view.produtora')->with('message', $message);
  }

  public function jobViewProdutora(Job $job) {
    $projeto = Projeto::find($job->projeto->id);
    $id = Auth::user()->id;
    $empresa = Empresa::find($id);
    $freelancers = $job->freelancers()->orderBy('nome')->get();
    $notificacoes = $empresa->projetos()->where('aceito', '=', 0)->get();

    return view('site.empresa.job.job-view-produtora', compact('empresa', 'job', 'projeto', 'freelancers', 'notificacoes'));
  }
}
