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
    $portifolios = Portifolio::where('empresa_id', $id)->get();

    return view('site.empresa.portifolio.portifolios-view', compact('empresa', 'portifolios'));
  }

  public function criarPortifolioView() {
    $id = Auth::user()->id;
    $empresa = Empresa::find($id);

    return view('site.empresa.portifolio.portifolio-novo', compact('empresa'));
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

  public function excluirNoticia(Noticia $noticia) {
    $delete = $noticia->delete();

    if ($delete)
    {
      $message = parent::returnMessage('success', 'Notícia/evento excluído com sucesso!');
    } else
    {
      $message = parent::returnMessage('danger', 'Erro ao excluir a notícia/evento!');
    }

    return redirect()->route('freelancer.perfil')->with('message', $message);
  }
}
