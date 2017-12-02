<?php

namespace App\Http\Controllers\Web\Freelancer;

use App\Freelancer;
use App\Endereco;
use App\Noticia;
use Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;

class FreelancerController extends Controller
{
  public function __construct() {
    $this->middleware('auth:freelancer');
    Carbon::setLocale('pt-br');
  }

  public function perfil() {
    $id = Auth::user()->id;
    $freelancer = Freelancer::find($id);
    $noticias = Noticia::orderBy('created_at', 'desc')->where('freelancer_id', $id)->paginate(10);
    $notificacoes = $freelancer->projetos()->where('aceito', '=', 0)->get();
    $notificacoes2 = $freelancer->grupos()->where('aceito', '=', 0)->get();

    return view('site.freelancer.perfil', compact('freelancer', 'noticias', 'notificacoes', 'notificacoes2'));
  }

  public function editarPerfil() {
    $id = Auth::user()->id;
    $freelancer = Freelancer::find($id);
    $notificacoes = $freelancer->projetos()->where('aceito', '=', 0)->get();
    $notificacoes2 = $freelancer->grupos()->where('aceito', '=', 0)->get();

    return view('site.freelancer.perfil-editar', compact('freelancer', 'notificacoes', 'notificacoes2'));
  }

  public function editarInfomacoes(Request $request) {

    if ($request->profile_photo == null) {
      $freelancerOld = Freelancer::find($request->freelancer);
      $filename = $freelancerOld->foto_perfil;
    } else {
      $filename = config('app.name') . '_foto_perfil' . str_slug($request->email, '_') . '_' . $request->file('profile_photo')->getClientOriginalName();
      $request->profile_photo->storeAs('freelancers/perfil', $filename, 'public');
    }

    Freelancer::where('id', $request->freelancer)
    ->update(['nome' => $request->nome,
      'cpf' => $request->cpf,
      'password' => bcrypt($request->senha),
      'endereco_id' => $request->endereco,
      'foto_perfil' => $filename,
      'ativo' => 1,
      'account_confirmation' => hash_hmac('sha256', str_random(40), config('app.key'))]);

    $message = parent::returnMessage('success', 'Informações editadas com sucesso!');

    return redirect()->route('freelancer.editar-perfil.view')->with('message', $message);
  }

  public function editarEndereco(Request $request) {
    Endereco::where('id', $request->enderecoId)
    ->update(['cep' => $request->cep,
      'logradouro' => $request->logradouro,
      'numero' => $request->numero,
      'complemento' => $request->complemento,
      'bairro' => $request->bairro,
      'cidade' => $request->cidade,
      'uf' => $request->uf]);

    $message = parent::returnMessage('success', 'Endereço editado com sucesso!');

    return redirect()->route('freelancer.editar-perfil.view')->with('message', $message);
  }
}
