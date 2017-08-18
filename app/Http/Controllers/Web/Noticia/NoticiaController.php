<?php

namespace App\Http\Controllers\Web\Noticia;

use App\Noticia;
use Illuminate\Http\Request;

class NoticiaController extends Controller
{
  public function noticiasViewHome() {
    $noticias = Noticia::paginate(3);
    return view('site.eventos', compact('noticias'));
  }

  public function noticiaView(Noticia $noticia) {
    return view ('site.evento-view', compact('noticia'));
  }
}