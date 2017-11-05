<?php

namespace App\Http\Controllers\Web\Empresa\Pesquisa;

use App\Conhecimento;
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
    $this->middleware('auth:empresa');
  }

  public function pesquisarView() {
    $id = Auth::user()->id;
    $empresa = Empresa::find($id);
    $produtoras = [];
    $freelancers = [];
    $cidades = Endereco::select('cidade', 'uf')->distinct()->get();
    $tecnologias = Conhecimento::all();

    return view('site.empresa.pesquisa.pesquisa-form', compact('empresa', 'produtoras', 'freelancers', 'cidades', 'tecnologias'));
  }

  public function pesquisar(Request $request) {
    $id = Auth::user()->id;
    $empresa = Empresa::find($id);
    $cidades = Endereco::select('cidade', 'uf')->distinct()->get();
    $tecnologias = Conhecimento::all();
    $cidadesCheckBoxes = $request->input('cidades');
    $categoria = $request->get('categoria');
    $pesquisa = $request->get('nome');
    $produtoras = [];
    $freelancers = [];

    // dd($cidadesCheckBoxessCheckboxes);

    if ($categoria == 0 && $pesquisa == null && $cidadesCheckBoxes == null) {
      $produtoras = Empresa::where('categoria', 'Produtora')->get();
      $freelancers = Freelancer::all();
    }elseif($categoria == 1 && $pesquisa == null && $cidadesCheckBoxes == null) {
      $freelancers = Freelancer::all();
    }elseif($categoria == 2 && $pesquisa == null && $cidadesCheckBoxes == null) {
      $produtoras = Empresa::where('categoria', 'Produtora')->get();
    } elseif($categoria == 0 && $pesquisa != null && $cidadesCheckBoxes == null) {
      $produtoras = Empresa::where('categoria', 'Produtora')
      ->orwhere('nome', 'like', '%' . $pesquisa . '%')
      ->orwhere('email', 'like', '%' . $pesquisa . '%')
      ->get();
      $freelancers = Freelancer::orwhere('nome', 'like', '%' . $pesquisa . '%')
      ->orwhere('email', 'like', '%' . $pesquisa . '%')
      ->get();
    } elseif($categoria == "0" && $pesquisa != null && $cidadesCheckBoxes == null) {
     $freelancers = Freelancer::orwhere('nome', 'like', '%' . $pesquisa . '%')
     ->orwhere('email', 'like', '%' . $pesquisa . '%')
     ->get();
   } elseif($categoria == 2 && $pesquisa != null && $cidadesCheckBoxes == null) {
    $produtoras = Empresa::where('categoria', 'Produtora')
    ->orwhere('nome', 'like', '%' . $pesquisa . '%')
    ->orwhere('email', 'like', '%' . $pesquisa . '%')
    ->get();
  }

  if ($categoria == 0 && $pesquisa == null && $cidadesCheckBoxes != null) {
   // $produtoras =  DB::select('SELECT F.* FROM EMPRESAS AS F INNER JOIN ENDERECOS AS E ON F.ENDERECO_ID = E.ID IN (E.CIDADE = :cidade) AND F.CATEGORIA = :produtora',
   //  ['cidade' => '1, 3, 4', 'produtora' => 'Produtora']);
    $cidades = "";
    for ($i = 0; $i < count($cidadesCheckBoxes); $i++) {
      if($i != 0) {
        $cidades = "'" . $cidades . "'" . ', ' . "'". $cidadesCheckBoxes[$i] . "'";
      }else {
        $cidades = $cidades . $cidadesCheckBoxes[$i];
      }
    }

    // dd($cidades);

    $freelancers =  DB::select('SELECT F.* FROM FREELANCERS AS F INNER JOIN ENDERECOS AS E ON F.ENDERECO_ID = E.ID WHERE E.CIDADE IN (?)', []);

    dd($freelancers);
  }elseif($categoria == 1 && $pesquisa == "" && $cidadesCheckBoxes != null) {
    $freelancers =  DB::select('SELECT F.id, F.nome, F.email FROM FREELANCERS AS F INNER JOIN ENDERECOS AS E ON F.ENDERECO_ID = E.ID IN cidade = :cidade', ['cidade' => $cidadesCheckBoxes]);
  }elseif($categoria == 2 && $pesquisa == "" && $cidadesCheckBoxes != null) {
    $produtoras =  DB::select('SELECT F.* FROM EMPRESAS AS F INNER JOIN ENDERECOS AS E ON F.ENDERECO_ID = E.ID IN E.CIDADE = :cidade AND F.CATEGORIA = :produtora',
      ['cidade' => $cidadesCheckBoxes, 'produtora' => 'Produtora']);
  } elseif($categoria == 0 && $pesquisa != "" && $cidadesCheckBoxes != null) {
    $produtoras = Empresa::where('categoria', 'Produtora')
    ->where('endereco_id', $cidadesCheckBoxes)
    ->orwhere('nome', 'like', '%' . $pesquisa . '%')
    ->orwhere('email', 'like', '%' . $pesquisa . '%')
    ->get();
    $freelancers = Freelancer::where('endereco_id', $cidadesCheckBoxes)
    ->orwhere('nome', 'like', '%' . $pesquisa . '%')
    ->orwhere('email', 'like', '%' . $pesquisa . '%')
    ->get();
  } elseif($categoria == 1 && $pesquisa != "" && $cidadesCheckBoxes != null) {
   $freelancers = Freelancer::where('endereco_id', $cidadesCheckBoxes)
   ->orwhere('nome', 'like', '%' . $pesquisa . '%')
   ->orwhere('email', 'like', '%' . $pesquisa . '%')
   ->get();
 } elseif($categoria == 2 && $pesquisa != "" && $cidadesCheckBoxes != null) {
  $produtoras = Empresa::where('categoria', 'Produtora')
  ->where('endereco_id', $cidadesCheckBoxes)
  ->orwhere('nome', 'like', '%' . $pesquisa . '%')
  ->orwhere('email', 'like', '%' . $pesquisa . '%')
  ->get();
}

return view('site.empresa.pesquisa.pesquisa-form', compact('empresa', 'produtoras', 'freelancers', 'cidades', 'tecnologias'));
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
  $freelancer = Freelancer::find($freelancer->id);

  return view('site.empresa.freelancer.conhecimentos-view-freelancer', compact('freelancer', 'noticias'));
}
}
