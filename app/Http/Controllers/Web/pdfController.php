<?php

namespace App\Http\Controllers\Web;

use App\Projeto;
use App\Job;
use PDF;
use Illuminate\Http\Request;

class pdfController extends Controller
{
  public function __construct() {
    $this->middleware('auth:empresa');
  }

  public function pdfProjeto(Projeto $projeto) {
    $freelancers = $projeto->freelancers()->orderBy('nome')->get();
    $produtoras = $projeto->empresas()->orderBy('nome')->get();
    $jobs = Job::orderBy('status', 'asc')->orderBy('created_at', 'desc')->where('projeto_id', $projeto->id)->get();

    $pdf = PDF::loadView('pdfs.pdf-projeto', ['projeto' => $projeto, 'freelancers' => $freelancers, 'produtoras' => $produtoras, 'jobs' => $jobs]);
    $data = new \DateTime();
    $stringData = $data->format(DATE_RFC2822);

    return $pdf->download('projeto_' . str_slug($projeto->titulo, '_') . "_" . str_slug($stringData, '_') . '.pdf');
  }

  public function pdfJob(Job $job) {
    $freelancers = $job->freelancers()->orderBy('nome')->get();
    $produtoras = $job->empresa()->orderBy('nome')->get();

    $pdf = PDF::loadView('pdfs.pdf-job', ['job' => $job, 'freelancers' => $freelancers, 'produtoras' => $produtoras]);
    $data = new \DateTime();
    $stringData = $data->format(DATE_RFC2822);

    return $pdf->download('projeto_' . str_slug($job->projeto->titulo, '_') . '_' .str_slug($job->titulo, '_') . "_" . str_slug($stringData, '_') . '.pdf');
  }
}
