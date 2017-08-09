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
    $empresas = Empresa::all()->where('ativo', '=', 1);
    return view('admin.empresa.empresas-view', compact('empresas'));
  }
}