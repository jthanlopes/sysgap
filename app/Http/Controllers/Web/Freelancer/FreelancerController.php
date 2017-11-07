<?php

namespace App\Http\Controllers\Web\Freelancer;

use App\Freelancer;
use App\Noticia;
use Auth;
use Illuminate\Http\Request;

class FreelancerController extends Controller
{
  public function __construct() {
    $this->middleware('auth:freelancer');
  }

  public function perfil() {
    $id = Auth::user()->id;
    $freelancer = Freelancer::find($id);
    $noticias = Noticia::orderBy('created_at', 'desc')->where('freelancer_id', $id)->paginate(10);
    $notificacoes = $freelancer->projetos()->where('aceito', '=', 0)->get();

    return view('site.freelancer.perfil', compact('freelancer', 'noticias', 'notificacoes'));
  }
}
