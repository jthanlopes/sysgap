<?php

namespace App\Http\Controllers\Web\Empresa\Noticia;

use App\Noticia;
use Auth;
use Illuminate\Http\Request;

class NoticiaController extends Controller
{  
  public function __construct() {    
    $this->middleware('auth:empresa');
  }  

  public function criarNoticia(Request $request) {        
    $file = 'teste';
    
    $create = Noticia::create([
      'titulo' => request('titulo'),
      'conteudo' => request('conteudo'),
      'imagem' => $file,
      'empresa_id' => Auth::user()->id,
      'ativo' => 1,
      'principal' => 0,
    ]);

    return redirect()->route('empresa.perfil');
  }
}
