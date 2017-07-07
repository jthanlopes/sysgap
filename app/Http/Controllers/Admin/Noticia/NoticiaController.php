<?php

namespace App\Http\Controllers\Admin\Noticia;

use App\Noticia;
use App\Empresa;
use Illuminate\Http\Request;

class NoticiaController extends Controller
{
  public function __construct() {
    $this->middleware('auth');
  }

  public function noticiasView() {
    $noticias = Noticia::all();
    return view('admin.noticia.noticias-view', compact('noticias'));
  }    

  public function conhecimentoNovo() {
    return view('admin.noticia.noticia-novo');
  }

  public function conhecimentoCadastrar(Request $request) {
    	// $this->validate(request(), [
     //        'title' => 'required|max:15',
     //        'body' => 'required'
     //  ]);

    $file = 'teste';

    auth()->user()->cadastrarNoticia(
      new Noticia(['titulo' => $request->titulo, 'conteudo' => $request->conteudo, 'imagem' => $file, 'data_final' => $request->data_final, 'ativo' => 1])
    );

    // Adicionar mensagem de sucesso e retornar para a view

    return redirect()->route('noticias.view');
  }

    // Mudar de lugar ___________________________________________________________

  public function empresasView() {
    $empresas = Empresa::all();
    return view('admin.empresa.empresas-view', compact('empresas'));
  } 

    // __________________________________________________________________________
}