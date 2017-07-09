<?php

namespace App\Http\Controllers\Web\Empresa\Job;

use App\Job;

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

    public function jobCadastrar(Request $request) {
      auth()->guard('empresa')->user()->cadastrarJob(
        new Job(['titulo' => $request->titulo, 'descricao' => $request->descricao, 
          'nivel_conhecimento_necessario' => $request->get('nivel'), 'status' => $request->get('status')])
        );

      return redirect()->route('empresa.perfil');
    }
}
