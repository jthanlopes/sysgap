<?php

namespace App\Http\Controllers\Admin\Item;

use App\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
  public function __construct() {
    $this->middleware('auth:web');
  }

  public function itensView() {
    $itens = Item::orderBy('created_at', 'desc')->paginate(10);

    return view('admin.item.itens-view', compact('itens'));
  }

  public function itemNovo() {
    return view('admin.item.item-novo');
  }

  public function itemCadastrar() {
    $create = Item::create([
      'pergunta' => request('pergunta'),
    ]);

    if ( $create )
    {
      $message = parent::returnMessage('success', 'Registro efetuado com sucesso!');
    } else
    {
      $message = parent::returnMessage('danger', 'Erro ao efetuar o registro!');
    }

    return redirect()->route('itens.view')->with('message', $message);
  }

  public function editarForm(Item $item) {
    return view ('admin.item.item-editar', compact('item'));
  }

  public function itemEditar(Request $request) {
    $update = Item::where( 'id', $request->idItem )
    ->update([
      'pergunta' => $request->pergunta,
    ]);

    if ( $update )
    {
      $message = parent::returnMessage('success', 'Alteração efetuada com sucesso!');
    } else
    {
      $message = parent::returnMessage('danger', 'Erro ao efetuar a alteração!');
    }

    return redirect()->route('itens.view')->with('message', $message);
  }

  public function itemExcluir(Item $item) {
    $exclusao = $item->delete();

    if ( $exclusao )
    {
      $message = parent::returnMessage('success', 'Exclusão efetuada com sucesso!');
    } else
    {
      $message = parent::returnMessage('danger', 'Erro ao fazer a exclusão!');
    }

    return redirect()->route('itens.view')->with('message', $message);
  }

}