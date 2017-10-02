<?php

namespace App\Http\Controllers\Web\Empresa;

use App\Empresa;
use App\Noticia;
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
        $noticias = Noticia::all()->where('empresa_id', $id);
        return view('site.empresa.perfil', compact('empresa', 'noticias'));
    }
}
