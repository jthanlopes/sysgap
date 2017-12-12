<?php

namespace App\Http\Controllers\Admin\Empresa;

use App\Empresa;
use Illuminate\Http\Request;

class EmpresaController extends Controller
{
  public function __construct() {
    $this->middleware('auth:web');
  }

  public function empresasView() {
    $empresas = Empresa::where('ativo', '=', 1)->orderBy('created_at')->get();
    return view('admin.empresa.empresas-view', compact('empresas'));
  }
}