<?php

namespace App\Http\Controllers\Admin\Noticia;

use App\Noticia;
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

    public function noticiaCadastrar() {
    	// $this->validate(request(), [
     //        'title' => 'required|max:15',
     //        'body' => 'required'
     //  ]);

        auth()->user()->publish(
            new Post(request(['title', 'body']))
        );

        // Post::create([
        //     'title' => request('title'), 
        //     'body' => request('body'), 
        //     'user_id' => auth()->id()
        // ]);

        // Redirecionar pra home page

        return redirect('/');
    }
}
