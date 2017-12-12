<?php

namespace App\Http\Controllers\Admin\Grupo;

use App\Grupo;
use Illuminate\Http\Request;

class GrupoController extends Controller
{
  public function __construct() {
    $this->middleware('auth:web');
  }

  public function gruposView() {
    $grupos = Grupo::orderBy('created_at')->get();
    return view('admin.grupo.grupos-view', compact('grupos'));
  }
}