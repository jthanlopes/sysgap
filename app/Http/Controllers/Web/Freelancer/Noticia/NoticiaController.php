<?php

namespace App\Http\Controllers\Web\Freelancer\Noticia;

use App\Noticia;
use App\Freelancer;
use Auth;
use Illuminate\Http\Request;
use Storage;

class NoticiaController extends Controller
{
  public function __construct() {
    $this->middleware('auth:freelancer');
  }

  public function criarNoticia(Request $request) {
   $id = Auth::user()->id;
   $freelancer = Freelancer::find($id);

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

    $verificaPontuacao = $freelancer->pontuacoes()->where('pontuacoe_id', 4)->count();

    if($verificaPontuacao == 0) {
      $pontuacaoId = 4;

      $freelancer->pontuacoes()->attach($pontuacaoId, ['created_at' => new \DateTime(), 'updated_at' => new \DateTime()]);
    }
  } else
  {
    $message = parent::returnMessage('danger', 'Erro ao postar a notícia/evento!');
  }

  return redirect()->route('freelancer.perfil')->with('message', $message);
}

public function editarNoticiaView(Noticia $noticia) {
  $id = Auth::user()->id;
  $freelancer = Freelancer::find($id);
  $notificacoes = $freelancer->projetos()->where('aceito', '=', 0)->get();
  $notificacoes2 = $freelancer->grupos()->where('aceito', '=', 0)->get();

  return view('site.freelancer.noticia.noticia-editar', compact('noticia', 'freelancer', 'notificacoes', 'notificacoes2'));
}

public function editarNoticia(Request $request) {
  if ($request->file('imagem') == null) {
    $noticia = Noticia::find($request->noticiaId);
    $filename = $noticia->imagem;
  } else {
   $filename = config('app.name') . '_post_' . Auth::user()->id . '_' . $request->file('imagem')->getClientOriginalName();
   $storage = 'freelancers/posts/' .  Auth::user()->id;
   $request->imagem->storeAs($storage, $filename, 'public');
 }

 Noticia::where('id', $request->noticiaId)
 ->update(['titulo' => request('titulo'),
  'conteudo' => request('conteudo'),
  'imagem' => $filename,
  'empresa_id' => Auth::user()->id,
  'ativo' => 1,
  'principal' => 0,
]);

 $message = parent::returnMessage('success', 'Notícia editada com sucesso!');

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
