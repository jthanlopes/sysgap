<?php

namespace App\Http\Controllers\Web\Empresa\Pesquisa;

use App\Conhecimento;
use App\Empresa;
use App\Freelancer;
use Auth;

use Illuminate\Http\Request;

class PesquisaController extends Controller
{
  public function __construct() {
    $this->middleware('auth:empresa');
  }

  public function pesquisarView(Request $request) {
    $id = Auth::user()->id;
    $empresa = Empresa::find($id);

    return view('site.empresa.pesquisa.pesquisa-form', compact('empresa'));
  }
}
