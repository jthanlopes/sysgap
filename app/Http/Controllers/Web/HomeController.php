<?php

namespace App\Http\Controllers\Web;

use App\Noticia;

class HomeController extends Controller
{
  public function home() {
    $noticia = Noticia::all()->first();

    return view('site.home', compact('noticia'));
  }
}