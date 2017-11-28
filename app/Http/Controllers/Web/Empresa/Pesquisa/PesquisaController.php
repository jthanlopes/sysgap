<?php

namespace App\Http\Controllers\Web\Empresa\Pesquisa;

use App\Conhecimento;
use App\Portifolio;
use App\Endereco;
use App\Empresa;
use App\Noticia;
use App\Freelancer;
use App\Grupo;
use Auth;
use Carbon\Carbon;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PesquisaController extends Controller
{
  public function __construct() {
    $this->middleware('auth:empresa');
    Carbon::setLocale('pt-br');
  }

  public function pesquisarView() {
    $id = Auth::user()->id;
    $empresa = Empresa::find($id);
    $produtoras = [];
    $freelancers = [];
    $grupos = [];
    $cidades = Endereco::select('cidade', 'uf')->distinct()->get();
    $tecnologias = Conhecimento::all();
    $notificacoes = $empresa->projetos()->where('aceito', '=', 0)->get();

    return view('site.empresa.pesquisa.pesquisa-form', compact('empresa', 'produtoras', 'freelancers', 'cidades', 'tecnologias', 'grupos', 'notificacoes'));
  }

  public function pesquisar(Request $request) {
    $id = Auth::user()->id;
    $empresa = Empresa::find($id);
    $notificacoes = $empresa->projetos()->where('aceito', '=', 0)->get();
    $cidades = Endereco::select('cidade', 'uf')->distinct()->get();
    $tecnologias = Conhecimento::all();
    $cidadesCheckBoxes = $request->input('cidades');
    $conhecimentosCheckBoxes = $request->input('tecnologias');
    // Cidades selecionadas
    if ($cidadesCheckBoxes != null) {
      $enderecos = Endereco::select('id')->wherein('cidade', $cidadesCheckBoxes)->get()->pluck('id')->toArray();
    }
    //
    // Conhecimentos selecionadas
    if ($conhecimentosCheckBoxes != null) {
      $conhecimentos = Conhecimento::select('id')->wherein('titulo', $conhecimentosCheckBoxes)->get()->pluck('id')->toArray();
    }
    //
    $categoria = $request->get('categoria');
    $pesquisa = $request->get('nome');
    $produtoras = [];
    $freelancers = [];
    $grupos = [];

    if ($categoria == 0 && $pesquisa == null && $cidadesCheckBoxes == null) {
      $produtoras = Empresa::where('categoria', 'Produtora')->get();
      $freelancers = Freelancer::all();
      $grupos = Grupo::all();
    }elseif($categoria == 1 && $pesquisa == null && $cidadesCheckBoxes == null) {
      $freelancers = Freelancer::all();
    }elseif($categoria == 2 && $pesquisa == null && $cidadesCheckBoxes == null) {
      $produtoras = Empresa::where('categoria', 'Produtora')->get();
    }elseif($categoria == 3 && $pesquisa == null && $cidadesCheckBoxes == null) {
      $grupos = Grupo::all();
    }elseif($categoria == 0 && $pesquisa != null && $cidadesCheckBoxes == null) {
      $produtoras = Empresa::where([['categoria', 'Produtora'],
        ['nome', 'like', '%' . $pesquisa . '%']])
      ->orwhere([['categoria', 'Produtora'],
        ['email', 'like', '%' . $pesquisa . '%']])
      ->get();
      $freelancers = Freelancer::where('nome', 'like', '%' . $pesquisa . '%')
      ->orwhere('email', 'like', '%' . $pesquisa . '%')
      ->get();
    } elseif($categoria == 1 && $pesquisa != null && $cidadesCheckBoxes == null) {
     $freelancers = Freelancer::where('nome', 'like', '%' . $pesquisa . '%')
     ->orwhere('email', 'like', "'%" . $pesquisa . "%'")
     ->get();
   } elseif($categoria == 2 && $pesquisa != null && $cidadesCheckBoxes == null) {
    $produtoras = Empresa::where([['categoria', 'Produtora'],
      ['nome', 'like', '%' . $pesquisa . '%']])
    ->orwhere([['categoria', 'Produtora'],
      ['email', 'like', '%' . $pesquisa . '%']])
    ->get();
  }

  if ($categoria == 0 && $pesquisa == null && $cidadesCheckBoxes != null) {
    $freelancers = Freelancer::wherein('endereco_id', $enderecos)->get();
    $produtoras = Empresa::where('categoria', 'Produtora')->wherein('endereco_id', $enderecos)->get();
  }elseif($categoria == 1 && $pesquisa == "" && $cidadesCheckBoxes != null) {
    $freelancers = Freelancer::wherein('endereco_id', $enderecos)->get();
  }elseif($categoria == 2 && $pesquisa == "" && $cidadesCheckBoxes != null) {
    $produtoras = Empresa::where('categoria', 'Produtora')->wherein('endereco_id', $enderecos)->get();
  } elseif($categoria == 0 && $pesquisa != "" && $cidadesCheckBoxes != null) {
    $produtoras = Empresa::wherein('endereco_id', $enderecos)
    ->where([['categoria', 'Produtora'],
      ['nome', 'like', '%' . $pesquisa . '%']])
    ->orwhere([['categoria', 'Produtora'],
      ['email', 'like', '%' . $pesquisa . '%']])
    ->get();
    $freelancers = Freelancer::wherein('endereco_id', $enderecos)
    ->where('nome', 'like', '%' . $pesquisa . '%')
    ->orwhere('email', 'like', '%' . $pesquisa . '%')
    ->get();
  } elseif($categoria == 1 && $pesquisa != "" && $cidadesCheckBoxes != null) {
   $freelancers = Freelancer::wherein('endereco_id', $enderecos)
   ->where('nome', 'like', '%' . $pesquisa . '%')
   ->orwhere('email', 'like', '%' . $pesquisa . '%')
   ->get();
 } elseif($categoria == 2 && $pesquisa != "" && $cidadesCheckBoxes != null) {
  $produtoras = Empresa::wherein('endereco_id', $enderecos)
  ->where([['categoria', 'Produtora'],
    ['nome', 'like', '%' . $pesquisa . '%']])
  ->orwhere([['categoria', 'Produtora'],
    ['email', 'like', '%' . $pesquisa . '%']])
  ->get();
}

return view('site.empresa.pesquisa.pesquisa-form', compact('empresa', 'produtoras', 'freelancers', 'grupos', 'cidades', 'tecnologias', 'grupos', 'notificacoes'));
}

public function viewPerfilProdutora(Empresa $produtora) {
  $noticias = Noticia::orderBy('created_at', 'desc')->where('empresa_id', $produtora->id)->paginate(10);

  return view('site.empresa.produtora.view-produtora', compact('produtora', 'noticias'));
}

public function viewPerfilFreelancer(Freelancer $freelancer) {
  $noticias = Noticia::orderBy('created_at', 'desc')->where('freelancer_id', $freelancer->id)->paginate(10);

  return view('site.empresa.freelancer.view-freelancer', compact('freelancer', 'noticias'));
}

public function viewConhecimentosFreelancer(Freelancer $freelancer) {
  return view('site.empresa.freelancer.conhecimentos-view-freelancer', compact('freelancer'));
}

public function viewConhecimentosProdutora(Empresa $empresa) {
  $produtora = $empresa;
  return view('site.empresa.produtora.conhecimentos-view-produtora', compact('produtora'));
}

public function viewPortifoliosFreelancer(Freelancer $freelancer) {
  $portifolios = Portifolio::orderBy('created_at', 'desc')->where('freelancer_id', $freelancer->id)->paginate(5);

  return view('site.empresa.freelancer.portifolio-view-freelancer', compact('freelancer', 'portifolios'));
}

public function viewPortifoliosProdutora(Empresa $empresa) {
  $portifolios = Portifolio::orderBy('created_at', 'desc')->where('empresa_id', $empresa->id)->paginate(5);
  $produtora = $empresa;

  return view('site.empresa.produtora.portifolios-view-produtora', compact('produtora', 'portifolios'));
}
}
