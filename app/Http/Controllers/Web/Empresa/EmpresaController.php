<?php

namespace App\Http\Controllers\Web\Empresa;

use App\Empresa;
use Auth;
use Illuminate\Http\Request;

class EmpresaController extends Controller
{
    public function __construct() {
        $this->middleware('auth:empresa');
    }

    public function perfil() {
        $id = Auth::user()->id;
        $empresa = Empresa::find($id);
        return view('site.empresa.perfil', compact('empresa'));
    }

    public function novoProjeto() {
      $id = Auth::user()->id;
      $empresa = Empresa::find($id);
      return view('site.empresa.criar-projeto', compact('empresa'));
    }

    public function criarProjeto() {

    }
}
