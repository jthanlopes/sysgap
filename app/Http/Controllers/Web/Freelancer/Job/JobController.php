<?php

namespace App\Http\Controllers\Web\Freelancer\Job;

use App\Job;
use App\Projeto;
use App\Freelancer;
use Auth;

use Illuminate\Http\Request;

class JobController extends Controller
{
  public function __construct() {
    $this->middleware('auth:freelancer');
  }

  public function jobsView(Projeto $projeto) {
    $id = Auth::user()->id;
    $freelancer = Freelancer::find($id);
    $notificacoes = $freelancer->projetos()->where('aceito', '=', 0)->get();

    if($projeto->titulo == null) {
      $jobs = Freelancer::find($id)->jobs()->paginate(10);
    } else {
      $jobs = Freelancer::find($id)->jobs()->where('projeto_id', $projeto->id)->paginate(10);
    }

    return view('site.freelancer.job.jobs-view', compact('freelancer', 'jobs', 'notificacoes'));
  }

  public function jobsViewProjeto() {
    $id = Auth::user()->id;
    $freelancer = Freelancer::find($id);
    $projetos = Freelancer::find($id)->projetos()->where('aceito', '!=', 3)->get();
    $notificacoes = $freelancer->projetos()->where('aceito', '=', 0)->get();

    return view('site.freelancer.job.jobs-view-projeto', compact('freelancer', 'projetos', 'notificacoes'));
  }

  public function aceitarProjeto(Projeto $projeto) {
    $id = Auth::user()->id;
    $freelancer = Freelancer::find($id);
    $freelancer->projetos()->updateExistingPivot($projeto->id, ['aceito' => 1]);

    $message = parent::returnMessage('success', 'Você aceitou o convite. Bem-vindo ao projeto!');

    return redirect('/freelancer/jobs-projetos/' . $projeto->id)->with('message', $message);
  }

  public function recusarProjeto(Projeto $projeto) {
    $id = Auth::user()->id;
    $freelancer = Freelancer::find($id);
    $freelancer->projetos()->updateExistingPivot($projeto->id, ['aceito' => 3]);

    $message = parent::returnMessage('success', 'Você recusou o convite!');

    return redirect()->route('jobs.projeto.view')->with('message', $message);
  }
}
