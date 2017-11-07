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
    $projetos = Freelancer::find($id)->projetos()->get();
    $notificacoes = $freelancer->projetos()->where('aceito', '=', 0)->get();

    return view('site.freelancer.job.jobs-view-projeto', compact('freelancer', 'projetos', 'notificacoes'));
  }
}
