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
    $agencias = [];
    $tipo = "usuários";
    $cidades = Endereco::select('cidade', 'uf')->distinct()->get();
    $tecnologias = Conhecimento::all();
    $notificacoes = $empresa->projetos()->where('aceito', '=', 0)->get();

    return view('site.empresa.pesquisa.pesquisa-form', compact('empresa', 'produtoras', 'freelancers', 'cidades', 'tecnologias', 'agencias', 'notificacoes', 'tipo'));
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
      $conhecimentosCheck = Conhecimento::whereIn('id', $conhecimentos)->get();
      $freelas = [];
      $empres = [];

      foreach ($conhecimentosCheck as $conhecimentoF) {
        foreach ($conhecimentoF->freelancers as $freelancer) {
          array_push($freelas, $freelancer->id);
        }
      }

      foreach ($conhecimentosCheck as $conhecimentoE) {
        foreach ($conhecimentoE->empresas as $empresa) {
          array_push($empres, $empresa->id);
        }
      }
    }
    //
    $categoria = $request->get('categoria');
    $pesquisa = $request->get('nome');
    $agencias = [];
    $produtoras = [];
    $freelancers = [];
    $tipo = "usuários";

    if ($categoria == 0 && $pesquisa == null && $cidadesCheckBoxes == null && $conhecimentosCheckBoxes == null) {
      $produtoras = Empresa::where('categoria', 'Produtora')->get();
      $freelancers = Freelancer::all();
      $agencias = Empresa::where('categoria', 'Agência')->get();
    }elseif($categoria == 1 && $pesquisa == null && $cidadesCheckBoxes == null && $conhecimentosCheckBoxes == null) {
      $freelancers = Freelancer::all();
      $tipo = "freelancers";
    }elseif($categoria == 2 && $pesquisa == null && $cidadesCheckBoxes == null && $conhecimentosCheckBoxes == null) {
      $produtoras = Empresa::where('categoria', 'Produtora')->get();
      $tipo = "produtoras";
    }elseif($categoria == 3 && $pesquisa == null && $cidadesCheckBoxes == null && $conhecimentosCheckBoxes == null) {
      $agencias = Empresa::where('categoria', 'Agência')->get();
      $tipo = "agências";
    }elseif($categoria == 0 && $pesquisa != null && $cidadesCheckBoxes == null && $conhecimentosCheckBoxes == null) {
      $produtoras = Empresa::where([['categoria', 'Produtora'],
        ['nome', 'like', '%' . $pesquisa . '%']])
      ->orwhere([['categoria', 'Produtora'],
        ['email', 'like', '%' . $pesquisa . '%']])
      ->get();
      $freelancers = Freelancer::where('nome', 'like', '%' . $pesquisa . '%')
      ->orwhere('email', 'like', '%' . $pesquisa . '%')
      ->get();
      $agencias = Empresa::where([['categoria', 'Agência'],
        ['nome', 'like', '%' . $pesquisa . '%']])
      ->orwhere([['categoria', 'Agência'],
        ['email', 'like', '%' . $pesquisa . '%']])
      ->get();
    } elseif($categoria == 1 && $pesquisa != null && $cidadesCheckBoxes == null && $conhecimentosCheckBoxes == null) {
     $freelancers = Freelancer::where('nome', 'like', '%' . $pesquisa . '%')
     ->orwhere('email', 'like', "'%" . $pesquisa . "%'")
     ->get();
     $tipo = "freelancers";
   } elseif($categoria == 2 && $pesquisa != null && $cidadesCheckBoxes == null && $conhecimentosCheckBoxes == null) {
    $produtoras = Empresa::where([['categoria', 'Produtora'],
      ['nome', 'like', '%' . $pesquisa . '%']])
    ->orwhere([['categoria', 'Produtora'],
      ['email', 'like', '%' . $pesquisa . '%']])
    ->get();
    $tipo = "produtoras";
  } elseif($categoria == 3 && $pesquisa != null && $cidadesCheckBoxes == null && $conhecimentosCheckBoxes == null) {
    $produtoras = Empresa::where([['categoria', 'Agência'],
      ['nome', 'like', '%' . $pesquisa . '%']])
    ->orwhere([['categoria', 'Agência'],
      ['email', 'like', '%' . $pesquisa . '%']])
    ->get();
    $tipo = "agências";
  }

  if ($categoria == 0 && $pesquisa == null && $cidadesCheckBoxes != null && $conhecimentosCheckBoxes == null) {
    $freelancers = Freelancer::wherein('endereco_id', $enderecos)->get();
    $produtoras = Empresa::where('categoria', 'Produtora')->wherein('endereco_id', $enderecos)->get();
    $agencias = Empresa::where('categoria', 'Agência')->wherein('endereco_id', $enderecos)->get();
  }elseif($categoria == 1 && $pesquisa == null && $cidadesCheckBoxes != null && $conhecimentosCheckBoxes == null) {
    $freelancers = Freelancer::wherein('endereco_id', $enderecos)->get();
    $tipo = "freelancers";
  }elseif($categoria == 2 && $pesquisa == null && $cidadesCheckBoxes != null && $conhecimentosCheckBoxes == null) {
    $produtoras = Empresa::where('categoria', 'Produtora')->wherein('endereco_id', $enderecos)->get();
    $tipo = "produtoras";
  } elseif($categoria == 3 && $pesquisa == null && $cidadesCheckBoxes != null && $conhecimentosCheckBoxes == null) {
    $produtoras = Empresa::where('categoria', 'Agência')->wherein('endereco_id', $enderecos)->get();
    $tipo = "agências";
  } elseif($categoria == 0 && $pesquisa != null && $cidadesCheckBoxes != null && $conhecimentosCheckBoxes == null) {
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
    $produtoras = Empresa::wherein('endereco_id', $enderecos)
    ->where([['categoria', 'Agência'],
      ['nome', 'like', '%' . $pesquisa . '%']])
    ->orwhere([['categoria', 'Agência'],
      ['email', 'like', '%' . $pesquisa . '%']])
    ->get();
  } elseif($categoria == 1 && $pesquisa != null && $cidadesCheckBoxes != null && $conhecimentosCheckBoxes == null) {
   $freelancers = Freelancer::wherein('endereco_id', $enderecos)
   ->where('nome', 'like', '%' . $pesquisa . '%')
   ->orwhere('email', 'like', '%' . $pesquisa . '%')
   ->get();
   $tipo = "freelancers";
 } elseif($categoria == 2 && $pesquisa != null && $cidadesCheckBoxes != null && $conhecimentosCheckBoxes == null) {
  $produtoras = Empresa::wherein('endereco_id', $enderecos)
  ->where([['categoria', 'Produtora'],
    ['nome', 'like', '%' . $pesquisa . '%']])
  ->orwhere([['categoria', 'Produtora'],
    ['email', 'like', '%' . $pesquisa . '%']])
  ->get();
  $tipo = "produtoras";
} elseif($categoria == 3 && $pesquisa != null && $cidadesCheckBoxes != null && $conhecimentosCheckBoxes == null) {
  $produtoras = Empresa::wherein('endereco_id', $enderecos)
  ->where([['categoria', 'Agência'],
    ['nome', 'like', '%' . $pesquisa . '%']])
  ->orwhere([['categoria', 'Agência'],
    ['email', 'like', '%' . $pesquisa . '%']])
  ->get();
  $tipo = "agências";
}

//
// Busca por conhecimentos
if ($categoria == 0 && $pesquisa == null && $cidadesCheckBoxes == null && $conhecimentosCheckBoxes != null) {
  $freelancers = Freelancer::find($freelas);
  $produtoras = Empresa::find($empres)->where('categoria', 'Produtora');
  $agencias = Empresa::find($empres)->where('categoria', 'Agência');
} elseif ($categoria == 1 && $pesquisa == null && $cidadesCheckBoxes == null && $conhecimentosCheckBoxes != null) {
  $freelancers = Freelancer::find($freelas);
  $tipo = "freelancers";
} elseif($categoria == 2 && $pesquisa == null && $cidadesCheckBoxes == null && $conhecimentosCheckBoxes != null) {
  $produtoras = Empresa::find($empres)->where('categoria', 'Produtora');
  $tipo = "produtoras";
} elseif($categoria == 3 && $pesquisa == null && $cidadesCheckBoxes == null && $conhecimentosCheckBoxes != null) {
  $agencias = Empresa::find($empres)->where('categoria', 'Agência');
  $tipo = "agências";
} elseif($categoria == 0 && $pesquisa != null && $cidadesCheckBoxes == null && $conhecimentosCheckBoxes != null) {
  $freelancers = Freelancer::wherein('id', $freelas)
  ->where('nome', 'like', '%' . $pesquisa . '%')
  ->orwhere('email', 'like', '%' . $pesquisa . '%')->get();

  $produtoras = Empresa::wherein('id', $empres)
  ->where([['categoria', 'Produtora'],
    ['nome', 'like', '%' . $pesquisa . '%']])
  ->orwhere([['categoria', 'Produtora'],
    ['email', 'like', '%' . $pesquisa . '%']]);

  $agencias = Empresa::wherein('id', $empres)->where([['categoria', 'Agência'],
    ['nome', 'like', '%' . $pesquisa . '%']])
  ->orwhere([['categoria', 'Agência'],
    ['email', 'like', '%' . $pesquisa . '%']]);

} elseif($categoria == 1 && $pesquisa != null && $cidadesCheckBoxes == null && $conhecimentosCheckBoxes != null) {
  $freelancers = Freelancer::wherein('id', $freelas)
  ->where('nome', 'like', '%' . $pesquisa . '%')
  ->orwhere('email', 'like', '%' . $pesquisa . '%')->get();
  $tipo = "freelancers";
} elseif($categoria == 2 && $pesquisa != null && $cidadesCheckBoxes == null && $conhecimentosCheckBoxes != null) {
  $produtoras = Empresa::wherein('id', $empres)
  ->where([['categoria', 'Produtora'],
    ['nome', 'like', '%' . $pesquisa . '%']])
  ->orwhere([['categoria', 'Produtora'],
    ['email', 'like', '%' . $pesquisa . '%']]);
  $tipo = "produtoras";
} elseif($categoria == 3 && $pesquisa != null && $cidadesCheckBoxes == null && $conhecimentosCheckBoxes != null) {
  $agencias = Empresa::wherein('id', $empres)->where([['categoria', 'Agência'],
    ['nome', 'like', '%' . $pesquisa . '%']])
  ->orwhere([['categoria', 'Agência'],
    ['email', 'like', '%' . $pesquisa . '%']]);
  $tipo = "agências";
} elseif($categoria == 0 && $pesquisa == null && $cidadesCheckBoxes != null && $conhecimentosCheckBoxes != null) {
  $produtoras = Empresa::wherein('id', $empres)
  ->wherein('endereco_id', $enderecos)->where('categoria', 'Produtora')->get();
  $freelancers = Freelancer::wherein('id', $freelas)->wherein('endereco_id', $enderecos)->get();
  $agencias = Empresa::wherein('id', $empres)
  ->wherein('endereco_id', $enderecos)->where('categoria', 'Agência')->get();
} elseif ($categoria == 1 && $pesquisa == null && $cidadesCheckBoxes != null && $conhecimentosCheckBoxes != null) {
  $freelancers = Freelancer::wherein('id', $freelas)->wherein('endereco_id', $enderecos)->get();
  $tipo = "freelancers";
} elseif($categoria == 2 && $pesquisa == null && $cidadesCheckBoxes != null && $conhecimentosCheckBoxes != null) {
  $produtoras = Empresa::wherein('id', $empres)
  ->wherein('endereco_id', $enderecos)->where('categoria', 'Produtora')->get();
  $tipo = "produtoras";
} elseif($categoria == 3 && $pesquisa == null && $cidadesCheckBoxes != null && $conhecimentosCheckBoxes != null) {
  $agencias = Empresa::wherein('id', $empres)
  ->wherein('endereco_id', $enderecos)->where('categoria', 'Agência')->get();
  $tipo = "agências";
} elseif($categoria == 0 && $pesquisa != null && $cidadesCheckBoxes != null && $conhecimentosCheckBoxes != null) {
  $produtoras = Empresa::wherein('id', $empres)
  ->wherein('endereco_id', $enderecos)
  ->where([['categoria', 'Produtora'],
    ['nome', 'like', '%' . $pesquisa . '%']])
  ->orwhere([['categoria', 'Produtora'],
    ['email', 'like', '%' . $pesquisa . '%']])
  ->get();
  $freelancers = Freelancer::wherein('id', $freelas)
  ->wherein('endereco_id', $enderecos)
  ->where('nome', 'like', '%' . $pesquisa . '%')
  ->orwhere('email', 'like', '%' . $pesquisa . '%')
  ->get();
  $agencias = Empresa::wherein('id', $empres)
  ->wherein('endereco_id', $enderecos)
  ->where([['categoria', 'Agência'],
    ['nome', 'like', '%' . $pesquisa . '%']])
  ->orwhere([['categoria', 'Agência'],
    ['email', 'like', '%' . $pesquisa . '%']])
  ->get();
} elseif ($categoria == 1 && $pesquisa != null && $cidadesCheckBoxes != null && $conhecimentosCheckBoxes != null) {
  $freelancers = Freelancer::wherein('id', $freelas)
  ->wherein('endereco_id', $enderecos)
  ->where('nome', 'like', '%' . $pesquisa . '%')
  ->orwhere('email', 'like', '%' . $pesquisa . '%')
  ->get();
  $tipo = "freelancers";
} elseif ($categoria == 2 && $pesquisa != null && $cidadesCheckBoxes != null && $conhecimentosCheckBoxes != null) {
  $produtoras = Empresa::wherein('id', $empres)
  ->wherein('endereco_id', $enderecos)
  ->where([['categoria', 'Produtora'],
    ['nome', 'like', '%' . $pesquisa . '%']])
  ->orwhere([['categoria', 'Produtora'],
    ['email', 'like', '%' . $pesquisa . '%']])
  ->get();
  $tipo = "produtoras";
} elseif ($categoria == 3 && $pesquisa != null && $cidadesCheckBoxes != null && $conhecimentosCheckBoxes != null) {
  $agencias = Empresa::wherein('id', $empres)
  ->wherein('endereco_id', $enderecos)
  ->where([['categoria', 'Agência'],
    ['nome', 'like', '%' . $pesquisa . '%']])
  ->orwhere([['categoria', 'Agência'],
    ['email', 'like', '%' . $pesquisa . '%']])
  ->get();
  $tipo = "agências";
}

return view('site.empresa.pesquisa.pesquisa-form', compact('empresa', 'produtoras', 'freelancers', 'cidades', 'tecnologias', 'agencias', 'notificacoes', 'tipo'));
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
