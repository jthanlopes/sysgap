<?php

namespace App\Http\Controllers\Web\Empresa\Noticia;

use App\Noticia;
use Auth;
use Illuminate\Http\Request;
use Storage;

class NoticiaController extends Controller
{  
  public function __construct() {    
    $this->middleware('auth:empresa');
  }  

  public function criarNoticia(Request $request) {
    // $filename = config('app.name') . $request->file('imagem')->getClientOriginalName();
    $filename = config('app.name') . '_post_' . Auth::user()->id . '_' . $request->file('imagem')->getClientOriginalName();
    $storage = 'empresas/posts/' .  str_slug(Auth::user()->nome, '_');
    $request->imagem->storeAs($storage, $filename, 'public');
    
    $create = Noticia::create([
      'titulo' => request('titulo'),
      'conteudo' => request('conteudo'),
      'imagem' => $filename,
      'empresa_id' => Auth::user()->id,
      'ativo' => 1,
      'principal' => 0,
    ]);

    return redirect()->route('empresa.perfil');
  }
}
