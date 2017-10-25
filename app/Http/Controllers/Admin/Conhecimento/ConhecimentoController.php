<?php

namespace App\Http\Controllers\Admin\Conhecimento;

use App\Conhecimento;
use Illuminate\Http\Request;

class ConhecimentoController extends Controller
{
    public function __construct() {
        $this->middleware('auth:web');
    }

    public function conhecimentosView() {
        $conhecimentos = Conhecimento::all();
    	return view('admin.conhecimento.conhecimentos-view', compact('conhecimentos'));
    }
    
    public function conhecimentoNovo() {
        return view('admin.conhecimento.conhecimento-novo');
    }

    public function editarForm(Conhecimento $conhecimento) {
        return view ('admin.conhecimento.conhecimento-editar', compact('conhecimento'));
    }

    public function conhecimentoCadastrar() {
            // Validator::make([
            //     'titulo' => 'required|max:15',
            //     'nivel'  => 'required',
            // ]);
            
           $create = Conhecimento::create([
                'titulo' => request('titulo'), 
                'descricao' => request('descricao'),
                'nivel' =>  request('nivel'),
                'padrao' => 1,
            ]);

            if ( $create )
            {
                $message = parent::returnMessage('success', 'Registro efetuado com sucesso!');
            } else 
            {
                $message = parent::returnMessage('danger', 'Erro ao efetuar o registro!');
            }

            return redirect()->route('conhecimentos.view')->with('message', $message);
    }

    public function conhecimentoPesquisar(Request $request) {
        $conhecimentos = Conhecimento::orWhere('titulo', 'like', '%' . $request->pesquisa . '%')->get();

        return view('admin.conhecimento.conhecimentos-view', compact('conhecimentos'));
    }

    public function conhecimentoEditar(Request $request) {
    	$this->validate($request, [
            'titulo' => 'required|max:15',
            'nivel'  => 'required',
        ]);

        $update = Conhecimento::where( 'id', $request->idConhecimento )
                                ->update([
                                    'titulo' => $request->titulo,
                                    'descricao' => $request->descricao, 
                                    'nivel' => $request->nivel,
                                    'padrao' => 1,
                                ]);

        if ( $update )
        {
            $message = parent::returnMessage('success', 'Alteração efetuada com sucesso!');
        } else 
        {
            $message = parent::returnMessage('danger', 'Erro ao efetuar a alteração!');
        }

        return redirect()->route('conhecimentos.view')->with('message', $message);
    }

    public function conhecimentoExcluir(Conhecimento $conhecimento) {
        $exclusao = $conhecimento->delete();

        if ( $exclusao )
        {
            $message = parent::returnMessage('success', 'Exclusão efetuada com sucesso!');
        } else 
        {
            $message = parent::returnMessage('danger', 'Erro ao fazer a exclusão!');
        }

        return redirect()->route('conhecimentos.view')->with('message', $message);
    }
}
