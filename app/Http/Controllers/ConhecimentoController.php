<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Conhecimento;

class ConhecimentoController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function conhecimentosView() {
        $conhecimentos = Conhecimento::all();
    	return view('admin.conhecimentos-view', compact('conhecimentos'));
    }

    // public function show(Post $post) {        
    // 	return view ('posts.show', compact('post'));
    // }

    public function criacao() {
        return view ('admin');
    }

    // public function store() {
    // 	$this->validate(request(), [
    //         'title' => 'required|max:15',
    //         'body' => 'required'
    //     ]);

    //     auth()->user()->publish(
    //         new Post(request(['title', 'body']))
    //     );

    //     // Post::create([
    //     //     'title' => request('title'), 
    //     //     'body' => request('body'), 
    //     //     'user_id' => auth()->id()
    //     // ]);

    //     // Redirecionar pra home page

    //     return redirect('/');
    // }
}
