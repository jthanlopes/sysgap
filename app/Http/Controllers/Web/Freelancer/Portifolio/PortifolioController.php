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
    $portifolios = Portifolio::where('freelancer_id', $id)->paginate(5);

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

  public function editarPortifolioView(Portifolio $portifolio) {
    $id = Auth::user()->id;
    $freelancer = Freelancer::find($id);
    $notificacoes = $freelancer->projetos()->where('aceito', '=', 0)->get();

    return view('site.freelancer.portifolio.portifolio-editar', compact('freelancer', 'notificacoes', 'portifolio'));
  }

  public function editarPortifolio(Request $request) {
    if ($request->file('imagem') == null) {
      $portifolio = Portifolio::find($request->portifolio);
      $filename = $portifolio->imagem;
    } else {
      $filename = config('app.name') . '_portifolio_' . Auth::user()->id . '_' . $request->file('imagem')->getClientOriginalName();
      $storage = 'freelancers/portifolio/' .  Auth::user()->id;
      $request->imagem->storeAs($storage, $filename, 'public');
    }

    Portifolio::where('id', $request->portifolio)
    ->update(['titulo' => $request->titulo,
      'link' => $request->link,
      'freelancer_id' => Auth::user()->id,
      'imagem' => $filename,
    ]);

    $message = parent::returnMessage('success', 'Portifólio editado com sucesso!');

    return redirect()->route('portifolios.view')->with('message', $message);
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

    return redirect()->route('portifolios.view')->with('message', $message);
  }
}
