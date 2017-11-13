<?php

namespace App\Http\Controllers\Web\Freelancer\Noticia;

use App\Noticia;
use Auth;
use Illuminate\Http\Request;
use Storage;

class NoticiaController extends Controller
{
  public function __construct() {
    $this->middleware('auth:freelancer');
  }

  public function criarNoticia(Request $request) {
    $filename = config('app.name') . '_post_' . Auth::user()->id . '_' . $request->file('imagem')->getClientOriginalName();
    $storage = 'freelancers/posts/' .  Auth::user()->id;
    $request->imagem->storeAs($storage, $filename, 'public');

    $create = Noticia::create([
      'titulo' => request('titulo'),
      'conteudo' => request('conteudo'),
      'imagem' => $filename,
      'freelancer_id' => Auth::user()->id,
      'ativo' => 1,
      'principal' => 0,
    ]);

    if ($create)
    {
      $message = parent::returnMessage('success', 'Notícia/evento postado com sucesso!');
    } else
    {
      $message = parent::returnMessage('danger', 'Erro ao postar a notícia/evento!');
    }

    return redirect()->route('freelancer.perfil')->with('message', $message);
  }

  public function excluirNoticia(Noticia $noticia) {
    $delete = $noticia->delete();

    if ($delete)
    {
      $message = parent::returnMessage('success', 'Notícia/evento excluído com sucesso!');
    } else
    {
      $message = parent::returnMessage('danger', 'Erro ao excluir a notícia/evento!');
    }

    return redirect()->route('freelancer.perfil')->with('message', $message);
  }
}
