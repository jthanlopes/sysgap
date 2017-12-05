<?php

namespace App\Http\Controllers\Admin\Pontuacao;

use App\Pontuacoe;
use Illuminate\Http\Request;

class PontuacaoController extends Controller
{
  public function __construct() {
    $this->middleware('auth:web');
  }

  public function pontuacoesView() {
    $pontuacoes = Pontuacoe::orderBy('created_at', 'desc')->paginate(10);

    return view('admin.pontuacao.pontuacoes-view', compact('pontuacoes'));
  }

  public function pontuacaoNovo() {
    return view('admin.pontuacao.pontuacao-novo');
  }

  public function pontuacaoCadastrar() {
    $create = Pontuacoe::create([
      'descricao' => request('descricao'),
      'valor' => request('valor'),
    ]);

    if ( $create )
    {
      $message = parent::returnMessage('success', 'Registro efetuado com sucesso!');
    } else
    {
      $message = parent::returnMessage('danger', 'Erro ao efetuar o registro!');
    }

    return redirect()->route('pontuacoes.view')->with('message', $message);
  }

  public function editarForm(Pontuacoe $pontuacao) {
    return view ('admin.pontuacao.pontuacao-editar', compact('pontuacao'));
  }

  public function pontuacaoEditar(Request $request) {
    $update = Pontuacoe::where( 'id', $request->idPontuacao )
    ->update([
      'descricao' => $request->descricao,
      'valor' => $request->valor,
    ]);

    if ( $update )
    {
      $message = parent::returnMessage('success', 'Alteração efetuada com sucesso!');
    } else
    {
      $message = parent::returnMessage('danger', 'Erro ao efetuar a alteração!');
    }

    return redirect()->route('pontuacoes.view')->with('message', $message);
  }

  public function pontuacaoExcluir(Pontuacoe $pontuacao) {
    $exclusao = $pontuacao->delete();

    if ( $exclusao )
    {
      $message = parent::returnMessage('success', 'Exclusão efetuada com sucesso!');
    } else
    {
      $message = parent::returnMessage('danger', 'Erro ao fazer a exclusão!');
    }

    return redirect()->route('pontuacoes.view')->with('message', $message);
  }

}