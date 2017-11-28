<?php

namespace App\Http\Controllers\Web\Empresa\Portifolio;

use Auth;
use App\Portifolio;
use App\Empresa;
use Illuminate\Http\Request;
use Storage;

class PortifolioController extends Controller
{
  public function __construct() {
    $this->middleware('auth:empresa');
  }

  public function portifoliosView() {
    $id = Auth::user()->id;
    $empresa = Empresa::find($id);
    $portifolios = Portifolio::where('empresa_id', $id)->paginate(5);
    $notificacoes = $empresa->projetos()->where('aceito', '=', 0)->get();

    return view('site.empresa.portifolio.portifolios-view', compact('empresa', 'portifolios', 'notificacoes'));
  }

  public function criarPortifolioView() {
    $id = Auth::user()->id;
    $empresa = Empresa::find($id);
    $notificacoes = $empresa->projetos()->where('aceito', '=', 0)->get();

    return view('site.empresa.portifolio.portifolio-novo', compact('empresa', 'notificacoes'));
  }

  public function criarPortifolio(Request $request) {
    $filename = config('app.name') . '_portifolio_' . Auth::user()->id . '_' . $request->file('imagem')->getClientOriginalName();
    $storage = 'empresas/portifolio/' .  Auth::user()->id;
    $request->imagem->storeAs($storage, $filename, 'public');

    $create = Portifolio::create([
      'titulo' => request('titulo'),
      'imagem' => $filename,
      'link' => request('link'),
      'empresa_id' => Auth::user()->id,
    ]);

    if ($create)
    {
      $message = parent::returnMessage('success', 'Portifólio cadastrado com sucesso!');
    } else
    {
      $message = parent::returnMessage('danger', 'Erro ao cadastrar o portifólio!');
    }

    return redirect()->route('portifolios.view.empresa')->with('message', $message);
  }

  public function editarPortifolioView(Portifolio $portifolio) {
    $id = Auth::user()->id;
    $empresa = Empresa::find($id);
    $notificacoes = $empresa->projetos()->where('aceito', '=', 0)->get();

    return view('site.empresa.portifolio.portifolio-editar', compact('empresa', 'portifolio', 'notificacoes'));
  }

  public function editarPortifolio(Request $request) {
    if ($request->file('imagem') == null) {
      $portifolio = Portifolio::find($request->portifolio);
      $filename = $portifolio->imagem;
    } else {
      $filename = config('app.name') . '_portifolio_' . Auth::user()->id . '_' . $request->file('imagem')->getClientOriginalName();
      $storage = 'empresas/portifolio/' .  Auth::user()->id;
      $request->imagem->storeAs($storage, $filename, 'public');
    }

    Portifolio::where('id', $request->portifolio)
    ->update(['titulo' => $request->titulo,
      'link' => $request->link,
      'empresa_id' => Auth::user()->id,
      'imagem' => $filename,
    ]);

    $message = parent::returnMessage('success', 'Portifólio editado com sucesso!');

    return redirect()->route('portifolios.view.empresa')->with('message', $message);
  }

  public function excluirPortifolio(Portifolio $portifolio) {
    $delete = $portifolio->delete();

    if ($delete)
    {
      $message = parent::returnMessage('success', 'Portifólio excluído com sucesso!');
    } else
    {
      $message = parent::returnMessage('danger', 'Erro ao excluir o Portifólio!');
    }

    return redirect()->route('portifolios.view.empresa')->with('message', $message);
  }
}
