<?php

namespace App\Http\Controllers\Admin;

use App\Conhecimento;
use Illuminate\Http\Request;

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

    public function conhecimentoNovo() {
        return view('admin.conhecimento-novo');
    }

    public function editarForm(Conhecimento $conhecimento) {
        return view ('admin.conhecimento-editar', compact('conhecimento'));
    }

    public function conhecimentoCadastrar() {
    	$this->validate(request(), [
            'titulo' => 'required|max:15',
            'nivel'  => 'required',
        ]);

        // auth()->user()->publish(
        //     new Post(request(['title', 'body']))
        // );

        Conhecimento::firstOrCreate([
            'titulo' => request('titulo'), 
            'descricao' => request('descricao'), 
            'nivel' => request('nivel'),
            'padrao' => 1,
        ]);

        return redirect()->route('conhecimentos.view')->with('message', 'Registro efetuado com sucesso!');
    }
}
