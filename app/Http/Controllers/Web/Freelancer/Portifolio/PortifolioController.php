<?php

namespace App\Http\Controllers\Web\Freelancer\Portifolio;

use Auth;
use App\Portifolio;
use App\Freelancer;
use Illuminate\Http\Request;
use Storage;

class PortifolioController extends Controller
{
  public function __construct() {
    $this->middleware('auth:freelancer');
  }

  public function portifoliosView() {
    $id = Auth::user()->id;
    $freelancer = Freelancer::find($id);
    $notificacoes = $freelancer->projetos()->where('aceito', '=', 0)->get();
    $portifolios = Portifolio::where('freelancer_id', $id)->get();

    return view('site.freelancer.portifolio.portifolios-view', compact('freelancer', 'notificacoes', 'portifolios'));
  }

  public function criarPortifolioView() {
    $id = Auth::user()->id;
    $freelancer = Freelancer::find($id);
    $notificacoes = $freelancer->projetos()->where('aceito', '=', 0)->get();

    return view('site.freelancer.portifolio.portifolio-novo', compact('freelancer', 'notificacoes'));
  }

  public function criarPortifolio(Request $request) {
    $filename = config('app.name') . '_portifolio_' . Auth::user()->id . '_' . $request->file('imagem')->getClientOriginalName();
    $storage = 'freelancers/portifolio/' .  Auth::user()->id;
    $request->imagem->storeAs($storage, $filename, 'public');

    $create = Portifolio::create([
      'titulo' => request('titulo'),
      'imagem' => $filename,
      'link' => request('link'),
      'freelancer_id' => Auth::user()->id,
    ]);

    if ($create)
    {
      $message = parent::returnMessage('success', 'Portifólio cadastrado com sucesso!');
    } else
    {
      $message = parent::returnMessage('danger', 'Erro ao cadastrar o portifólio!');
    }

    return redirect()->route('portifolios.view')->with('message', $message);
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
