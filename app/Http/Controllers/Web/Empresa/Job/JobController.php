<?php

namespace App\Http\Controllers\Web\Empresa\Job;

use App\Job;
use App\Projeto;
use Auth;
use App\Empresa;

use Illuminate\Http\Request;

class JobController extends Controller
{
  public function __construct() {
    $this->middleware('auth:empresa');
  }

  public function jobsViewJson() {
    $jobs = Job::where('status', 1)->get();

    return $jobs->toArray();
  }

  public function novoForm(Projeto $projeto) {
    $id = Auth::user()->id;
    $empresa = Empresa::find($id);

    return view('site.empresa.criar-job', compact('empresa', 'projeto'));
  }

  public function novo(Request $request) {
    // dd($request->projeto);
    auth()->guard('empresa')->user()->cadastrarJob(
      new Job(['titulo' => $request->titulo, 'descricao' => $request->descricao,
        'nivel_conhecimento_necessario' => $request->get('nivel'), 'status' => 'Aberto', 'projeto_id' => $request->projeto])
    );

    $message = parent::returnMessage('success', 'Job cadastrado com sucesso!');
  
    return redirect('/empresa/projeto/' . $request->projeto)->with('message', $message);
  }
}
