<?php

namespace App\Http\Controllers\Admin\Noticia;

use App\Noticia;
use App\Empresa;
use Illuminate\Http\Request;

class NoticiaController extends Controller
{
  public function __construct() {
    $this->middleware('auth:web');
  }

  public function noticiasView() {
    $noticias = Noticia::orderBy('created_at', 'desc')->where('admin_id', '<>', null)->paginate(10);

    return view('admin.noticia.noticias-view', compact('noticias'));
  }

  // Carrega a página com o formulário de cadastro das notícias
  public function noticiaNovo() {
    return view('admin.noticia.noticia-novo');
  }

  // Submete o formulário e salva a notícia no banco de dados
  // Depois retorna para a página de visualização das notícias
  public function noticiaCadastrar(Request $request) {
    	// $this->validate(request(), [
     //        'title' => 'required|max:15',
     //        'body' => 'required'
     //  ]);

    $file = 'teste';
    $principal;

    if($request->get('principal') == "Não") {
      $principal = 0;
    } else {
      $principal = 1;
    }

    auth()->user()->cadastrarNoticia(
      $create = new Noticia(['titulo' => $request->titulo, 'conteudo' => $request->conteudo, 'imagem' => $file, 'data_final' => $request->data_final, 'ativo' => 1, 'principal' => $principal])
    );

    // Adicionar mensagem de sucesso e retornar para a view
    if ($create)
    {
      $message = parent::returnMessage('success', 'Registro efetuado com sucesso!');
    } else
    {
      $message = parent::returnMessage('danger', 'Erro ao efetuar o registro!');
    }

    return redirect()->route('noticias.view')->with('message', $message);
  }
}