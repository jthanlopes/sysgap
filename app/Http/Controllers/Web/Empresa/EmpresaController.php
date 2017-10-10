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
        $noticias = Noticia::orderBy('created_at', 'desc')->where('empresa_id', $id)->paginate(10);
        return view('site.empresa.perfil', compact('empresa', 'noticias'));
    }
}
