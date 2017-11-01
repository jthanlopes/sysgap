<?php

namespace App\Http\Controllers\Web\Empresa\Pesquisa;

use App\Conhecimento;
use App\Endereco;
use App\Empresa;
use App\Freelancer;
use Auth;

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

    if ($categoria == 0 && $pesquisa == "" && $cidade == "") {
      $produtoras = Empresa::where('categoria', 'Produtora')->get();
      $freelancers = Freelancer::all();
    }elseif($categoria == 1 && $pesquisa == "" && $cidade == 0) {
      $freelancers = Freelancer::all();
    }elseif($categoria == 2 && $pesquisa == "" && $cidade == 0) {
      $produtoras = Empresa::where('categoria', 'Produtora')->get();
    } elseif($categoria == 0 && $pesquisa != "" && $cidade == 0) {
      $produtoras = Empresa::where('categoria', 'Produtora')
      ->orwhere('nome', 'like', '%' . $pesquisa . '%')
      ->orwhere('email', 'like', '%' . $pesquisa . '%')
      ->get();
      $freelancers = Freelancer::orwhere('nome', 'like', '%' . $pesquisa . '%')
      ->orwhere('email', 'like', '%' . $pesquisa . '%')
      ->get();
    } elseif($categoria == 1 && $pesquisa != "" && $cidade == 0) {
     $freelancers = Freelancer::orwhere('nome', 'like', '%' . $pesquisa . '%')
     ->orwhere('email', 'like', '%' . $pesquisa . '%')
     ->get();
   } elseif($categoria == 2 && $pesquisa != "" && $cidade == 0) {
    $produtoras = Empresa::where('categoria', 'Produtora')
    ->orwhere('nome', 'like', '%' . $pesquisa . '%')
    ->orwhere('email', 'like', '%' . $pesquisa . '%')
    ->get();
  }

  if ($categoria == 0 && $pesquisa == "" && $cidade != "") {
      $produtoras = Empresa::where('categoria', 'Produtora')->where('endereco_id', $cidade)->get();
      $freelancers = Freelancer::endereco()->where('cidade', $cidade);
    }elseif($categoria == 1 && $pesquisa == "" && $cidade != "") {
      $freelancers = Freelancer::where('endereco_id', $cidade);
    }elseif($categoria == 2 && $pesquisa == "" && $cidade != "") {
      $produtoras = Empresa::where('categoria', 'Produtora')->where('endereco_id', $cidade)->get();
    } elseif($categoria == 0 && $pesquisa != "" && $cidade != "") {
      $produtoras = Empresa::where('categoria', 'Produtora')
      ->where('endereco_id', $cidade)
      ->orwhere('nome', 'like', '%' . $pesquisa . '%')
      ->orwhere('email', 'like', '%' . $pesquisa . '%')
      ->get();
      $freelancers = Freelancer::where('endereco_id', $cidade)
      ->orwhere('nome', 'like', '%' . $pesquisa . '%')
      ->orwhere('email', 'like', '%' . $pesquisa . '%')
      ->get();
    } elseif($categoria == 1 && $pesquisa != "" && $cidade != "") {
     $freelancers = Freelancer::where('endereco_id', $cidade)
     ->orwhere('nome', 'like', '%' . $pesquisa . '%')
     ->orwhere('email', 'like', '%' . $pesquisa . '%')
     ->get();
   } elseif($categoria == 2 && $pesquisa != "" && $cidade != "") {
    $produtoras = Empresa::where('categoria', 'Produtora')
    ->where('endereco_id', $cidade)
    ->orwhere('nome', 'like', '%' . $pesquisa . '%')
    ->orwhere('email', 'like', '%' . $pesquisa . '%')
    ->get();
  }

  return view('site.empresa.pesquisa.pesquisa-form', compact('empresa', 'produtoras', 'freelancers', 'cidades'));
}
}
