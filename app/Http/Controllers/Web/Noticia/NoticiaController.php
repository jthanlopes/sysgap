<?php

namespace App\Http\Controllers\Web\Noticia;

use App\Noticia;
use Illuminate\Http\Request;

class NoticiaController extends Controller
{
  public function noticiasViewHome() {
    $noticias = Noticia::orderBy('created_at', 'desc')->where('admin_id', '<>', null)
    ->paginate(5);

    return view('site.eventos', compact('noticias'));
  }

  public function noticiaView(Noticia $noticia) {
    return view ('site.evento-view', compact('noticia'));
  }
}