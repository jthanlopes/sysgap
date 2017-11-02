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
    $cidades = Endereco::select('cidade')->distinct()->get();

    return view('site.empresa.pesquisa.pesquisa-form', compact('empresa', 'produtoras', 'freelancers', 'cidades'));
  }

  public function pesquisar(Request $request) {
    $id = Auth::user()->id;
    $empresa = Empresa::find($id);
    $cidades = Endereco::select('cidade')->distinct()->get();
    $categoria = $request->get('categoria');
    $cidade = $request->get('cidade');
    $pesquisa = $request->get('nome');
    $produtoras = [];
    $freelancers = [];

    if ($categoria == 0 && $pesquisa == null && $cidade == "0") {
      $produtoras = Empresa::where('categoria', 'Produtora')->get();
      $freelancers = Freelancer::all();
    }elseif($categoria == 1 && $pesquisa == null && $cidade == "0") {
      $freelancers = Freelancer::all();
    }elseif($categoria == 2 && $pesquisa == null && $cidade == "0") {
      $produtoras = Empresa::where('categoria', 'Produtora')->get();
    } elseif($categoria == 0 && $pesquisa != null && $cidade == "0") {
      $produtoras = Empresa::where('categoria', 'Produtora')
      ->orwhere('nome', 'like', '%' . $pesquisa . '%')
      ->orwhere('email', 'like', '%' . $pesquisa . '%')
      ->get();
      $freelancers = Freelancer::orwhere('nome', 'like', '%' . $pesquisa . '%')
      ->orwhere('email', 'like', '%' . $pesquisa . '%')
      ->get();
    } elseif($categoria == "0" && $pesquisa != null && $cidade == "0") {
     $freelancers = Freelancer::orwhere('nome', 'like', '%' . $pesquisa . '%')
     ->orwhere('email', 'like', '%' . $pesquisa . '%')
     ->get();
   } elseif($categoria == 2 && $pesquisa != null && $cidade == "0") {
    $produtoras = Empresa::where('categoria', 'Produtora')
    ->orwhere('nome', 'like', '%' . $pesquisa . '%')
    ->orwhere('email', 'like', '%' . $pesquisa . '%')
    ->get();
  }
  if ($categoria == 0 && $pesquisa == null && $cidade != "0") {
    $produtoras =  DB::select('SELECT * FROM EMPRESAS AS F INNER JOIN ENDERECOS AS E ON F.ENDERECO_ID = E.ID WHERE E.CIDADE = :cidade AND F.CATEGORIA = :produtora',
      ['cidade' => $cidade, 'produtora' => 'Produtora']);
    $freelancers =  DB::select('SELECT * FROM FREELANCERS AS F INNER JOIN ENDERECOS AS E ON F.ENDERECO_ID = E.ID WHERE E.CIDADE = :cidade',
      ['cidade' => $cidade]);
  }elseif($categoria == 1 && $pesquisa == "" && $cidade != "0") {
    $freelancers =  DB::select('SELECT * FROM FREELANCERS AS F INNER JOIN ENDERECOS AS E ON F.ENDERECO_ID = E.ID WHERE E.CIDADE = :cidade',
      ['cidade' => $cidade]);
  }elseif($categoria == 2 && $pesquisa == "" && $cidade != "0") {
    $produtoras =  DB::select('SELECT * FROM EMPRESAS AS F INNER JOIN ENDERECOS AS E ON F.ENDERECO_ID = E.ID WHERE E.CIDADE = :cidade AND F.CATEGORIA = :produtora',
      ['cidade' => $cidade, 'produtora' => 'Produtora']);
  } elseif($categoria == 0 && $pesquisa != "" && $cidade != "0") {
    $produtoras = Empresa::where('categoria', 'Produtora')
    ->where('endereco_id', $cidade)
    ->orwhere('nome', 'like', '%' . $pesquisa . '%')
    ->orwhere('email', 'like', '%' . $pesquisa . '%')
    ->get();
    $freelancers = Freelancer::where('endereco_id', $cidade)
    ->orwhere('nome', 'like', '%' . $pesquisa . '%')
    ->orwhere('email', 'like', '%' . $pesquisa . '%')
    ->get();
  } elseif($categoria == 1 && $pesquisa != "" && $cidade != "0") {
   $freelancers = Freelancer::where('endereco_id', $cidade)
   ->orwhere('nome', 'like', '%' . $pesquisa . '%')
   ->orwhere('email', 'like', '%' . $pesquisa . '%')
   ->get();
 } elseif($categoria == 2 && $pesquisa != "" && $cidade != "0") {
  $produtoras = Empresa::where('categoria', 'Produtora')
  ->where('endereco_id', $cidade)
  ->orwhere('nome', 'like', '%' . $pesquisa . '%')
  ->orwhere('email', 'like', '%' . $pesquisa . '%')
  ->get();
}

return view('site.empresa.pesquisa.pesquisa-form', compact('empresa', 'produtoras', 'freelancers', 'cidades'));
}

public function viewPerfilProdutora(Empresa $produtora) {
  $produtora = Empresa::find($produtora->id);
  $noticias = Noticia::orderBy('created_at', 'desc')->where('empresa_id', $produtora->id)->paginate(10);

  return view('site.empresa.produtora.view-produtora', compact('produtora', 'noticias'));
}
}
