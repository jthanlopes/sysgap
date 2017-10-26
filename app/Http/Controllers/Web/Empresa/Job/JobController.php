<?php

namespace App\Http\Controllers\Web\Empresa\Job;

use App\Job;
use App\Projeto;
use App\Empresa;

use Auth;
use Illuminate\Http\Request;

class JobController extends Controller
{
  public function __construct() {
    $this->middleware('auth:empresa');
  }

  public function jobView(Projeto $projeto, Job $job) {
    $id = Auth::user()->id;
    $empresa = Empresa::find($id);

    return view('site.empresa.job.job-view', compact('empresa', 'job', 'projeto'));
  }

  public function novoForm(Projeto $projeto) {
    $id = Auth::user()->id;
    $empresa = Empresa::find($id);

    return view('site.empresa.job.criar-job', compact('empresa', 'projeto'));
  }

  public function novo(Request $request) {
    auth()->guard('empresa')->user()->cadastrarJob(
      new Job(['titulo' => $request->titulo, 'descricao' => $request->descricao,
        'nivel_conhecimento_necessario' => $request->get('nivel'), 'status' => 'Aberto', 'projeto_id' => $request->projeto])
    );

    $message = parent::returnMessage('success', 'Job cadastrado com sucesso!');

    return redirect('/empresa/projeto/' . $request->projeto)->with('message', $message);
  }

  public function editarJobView(Projeto $projeto, Job $job) {
    $id = Auth::user()->id;
    $empresa = Empresa::find($id);

    return view('site.empresa.job.editar-job', compact('empresa', 'job'));
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
}
