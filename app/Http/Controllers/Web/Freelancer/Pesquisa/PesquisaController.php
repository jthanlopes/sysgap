<?php

namespace App\Http\Controllers\Web\Freelancer\Pesquisa;

use App\Conhecimento;
use App\Portifolio;
use App\Endereco;
use App\Empresa;
use App\Noticia;
use App\Freelancer;
use Auth;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PesquisaController extends Controller
{
  public function __construct() {
    $this->middleware('auth:freelancer');
  }

//   public function pesquisarView() {
//     $id = Auth::user()->id;
//     $empresa = Empresa::find($id);
//     $produtoras = [];
//     $freelancers = [];
//     $cidades = Endereco::select('cidade', 'uf')->distinct()->get();
//     $tecnologias = Conhecimento::all();
//     return view('site.empresa.pesquisa.pesquisa-form', compact('empresa', 'produtoras', 'freelancers', 'cidades', 'tecnologias'));
//   }

//   public function pesquisar(Request $request) {
//     $id = Auth::user()->id;
//     $empresa = Empresa::find($id);
//     $cidades = Endereco::select('cidade', 'uf')->distinct()->get();
//     $tecnologias = Conhecimento::all();
//     $cidadesCheckBoxes = $request->input('cidades');
//     $conhecimentosCheckBoxes = $request->input('tecnologias');
//     // Cidades selecionadas
//     if ($cidadesCheckBoxes != null) {
//       $enderecos = Endereco::select('id')->wherein('cidade', $cidadesCheckBoxes)->get()->pluck('id')->toArray();
//     }
//     //
//     // Conhecimentos selecionadas
//     if ($conhecimentosCheckBoxes != null) {
//       $conhecimentos = Conhecimento::select('id')->wherein('titulo', $conhecimentosCheckBoxes)->get()->pluck('id')->toArray();
//     }
//     //
//     $categoria = $request->get('categoria');
//     $pesquisa = $request->get('nome');
//     $produtoras = [];
//     $freelancers = [];

//     if ($categoria == 0 && $pesquisa == null && $cidadesCheckBoxes == null) {
//       $produtoras = Empresa::where('categoria', 'Produtora')->get();
//       $freelancers = Freelancer::all();
//     }elseif($categoria == 1 && $pesquisa == null && $cidadesCheckBoxes == null) {
//       $freelancers = Freelancer::all();
//     }elseif($categoria == 2 && $pesquisa == null && $cidadesCheckBoxes == null) {
//       $produtoras = Empresa::where('categoria', 'Produtora')->get();
//     } elseif($categoria == 0 && $pesquisa != null && $cidadesCheckBoxes == null) {
//       $produtoras = Empresa::where([['categoria', 'Produtora'],
//         ['nome', 'like', '%' . $pesquisa . '%']])
//       ->orwhere([['categoria', 'Produtora'],
//         ['email', 'like', '%' . $pesquisa . '%']])
//       ->get();
//       $freelancers = Freelancer::where('nome', 'like', '%' . $pesquisa . '%')
//       ->orwhere('email', 'like', '%' . $pesquisa . '%')
//       ->get();
//     } elseif($categoria == 1 && $pesquisa != null && $cidadesCheckBoxes == null) {
//      $freelancers = Freelancer::where('nome', 'like', '%' . $pesquisa . '%')
//      ->orwhere('email', 'like', "'%" . $pesquisa . "%'")
//      ->get();
//    } elseif($categoria == 2 && $pesquisa != null && $cidadesCheckBoxes == null) {
//     $produtoras = Empresa::where([['categoria', 'Produtora'],
//       ['nome', 'like', '%' . $pesquisa . '%']])
//     ->orwhere([['categoria', 'Produtora'],
//       ['email', 'like', '%' . $pesquisa . '%']])
//     ->get();
//   }

//   if ($categoria == 0 && $pesquisa == null && $cidadesCheckBoxes != null) {
//     $freelancers = Freelancer::wherein('endereco_id', $enderecos)->get();
//     $produtoras = Empresa::where('categoria', 'Produtora')->wherein('endereco_id', $enderecos)->get();
//   }elseif($categoria == 1 && $pesquisa == "" && $cidadesCheckBoxes != null) {
//     $freelancers = Freelancer::wherein('endereco_id', $enderecos)->get();
//   }elseif($categoria == 2 && $pesquisa == "" && $cidadesCheckBoxes != null) {
//     $produtoras = Empresa::where('categoria', 'Produtora')->wherein('endereco_id', $enderecos)->get();
//   } elseif($categoria == 0 && $pesquisa != "" && $cidadesCheckBoxes != null) {
//     $produtoras = Empresa::wherein('endereco_id', $enderecos)
//     ->where([['categoria', 'Produtora'],
//       ['nome', 'like', '%' . $pesquisa . '%']])
//     ->orwhere([['categoria', 'Produtora'],
//       ['email', 'like', '%' . $pesquisa . '%']])
//     ->get();
//     $freelancers = Freelancer::wherein('endereco_id', $enderecos)
//     ->where('nome', 'like', '%' . $pesquisa . '%')
//     ->orwhere('email', 'like', '%' . $pesquisa . '%')
//     ->get();
//   } elseif($categoria == 1 && $pesquisa != "" && $cidadesCheckBoxes != null) {
//    $freelancers = Freelancer::wherein('endereco_id', $enderecos)
//    ->where('nome', 'like', '%' . $pesquisa . '%')
//    ->orwhere('email', 'like', '%' . $pesquisa . '%')
//    ->get();
//  } elseif($categoria == 2 && $pesquisa != "" && $cidadesCheckBoxes != null) {
//   $produtoras = Empresa::wherein('endereco_id', $enderecos)
//   ->where([['categoria', 'Produtora'],
//     ['nome', 'like', '%' . $pesquisa . '%']])
//   ->orwhere([['categoria', 'Produtora'],
//     ['email', 'like', '%' . $pesquisa . '%']])
//   ->get();
// }

// return view('site.empresa.pesquisa.pesquisa-form', compact('empresa', 'produtoras', 'freelancers', 'cidades', 'tecnologias'));
// }

// public function viewPerfilProdutora(Empresa $produtora) {
//   $noticias = Noticia::orderBy('created_at', 'desc')->where('empresa_id', $produtora->id)->paginate(10);

//   return view('site.empresa.produtora.view-produtora', compact('produtora', 'noticias'));
// }

  public function viewPerfilFreelancer(Freelancer $freelancer) {
    $freela = auth()->user();
    $notificacoes = $freela->projetos()->where('aceito', '=', 0)->get();
    $notificacoes2 = $freelancer->grupos()->where('aceito', '=', 0)->get();
    $noticias = Noticia::orderBy('created_at', 'desc')->where('freelancer_id', $freelancer->id)->paginate(10);

    return view('site.empresa.freelancer.view-freelancer', compact('freelancer', 'noticias', 'notificacoes', 'notificacoes2'));
  }

  public function viewConhecimentosFreelancer(Freelancer $freelancer) {
    $freela = auth()->user();
    $notificacoes = $freela->projetos()->where('aceito', '=', 0)->get();
    $notificacoes2 = $freelancer->grupos()->where('aceito', '=', 0)->get();
    return view('site.empresa.freelancer.conhecimentos-view-freelancer', compact('freelancer', 'notificacoes', 'notificacoes2'));
  }

  public function viewPortifoliosFreelancer(Freelancer $freelancer) {
    $freela = auth()->user();
    $notificacoes = $freela->projetos()->where('aceito', '=', 0)->get();
    $notificacoes2 = $freelancer->grupos()->where('aceito', '=', 0)->get();
    $portifolios = Portifolio::orderBy('created_at', 'desc')->where('freelancer_id', $freelancer->id)->paginate(5);

    return view('site.empresa.freelancer.portifolio-view-freelancer', compact('freelancer', 'portifolios', 'notificacoes', 'notificacoes2'));
  }
}
