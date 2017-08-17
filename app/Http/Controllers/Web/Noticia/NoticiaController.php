<?php

namespace App\Http\Controllers\Web\Noticia;

use App\Noticia;
use Illuminate\Http\Request;

class NoticiaController extends Controller
{
  public function noticiasViewHome() {
    $noticias = Noticia::all();
    return view('site.eventos', compact('noticias'));
  }
}