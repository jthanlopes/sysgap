<?php

namespace App\Http\Controllers\Web\Freelancer;

use App\Freelancer;
use App\Endereco;
use App\Mail\ConfirmaContaFreelancer;
use Illuminate\Http\Request;
use Storage;

class FreelancerRegisterController extends Controller
{
  public function __construct() {
    $this->middleware('guest:freelancer');
  }

  public function registroView() {
    return view('site.registro-freelancer');
  }

  public function novo(Request $request) {
    $endereco = Endereco::create([
      'cep' => request('cep'),
      'logradouro' => request('logradouro'),
      'numero' => request('numero'),
      'complemento' => request('complemento'),
      'bairro' => request('bairro'),
      'cidade' => request('cidade'),
      'uf' => request('uf'),
    ]);

    // Salvar o endereço primeiro
    $endereco->save();

    $filename = config('app.name') . '_foto_perfil' . str_slug($request->email, '_') . '_' . $request->file('profile_photo')->getClientOriginalName();
    $request->profile_photo->storeAs('freelancers/perfil', $filename, 'public');

    $freelancer = Freelancer::create([
      'nome' => $request->nome,
      'email' => $request->email,
      'cpf' => $request->cpf,
      'password' => bcrypt($request->senha),
      'foto_perfil' => $filename,
      'endereco_id' => $endereco['id'],
      'ativo' => 1,
      'account_confirmation' => hash_hmac('sha256', str_random(40), config('app.key')),
    ]);

    $freelancer->save();

    \Mail::to($freelancer)->send(new ConfirmaContaFreelancer($freelancer));

    if ( $freelancer )
    {
      $message = parent::returnMessage('info', 'Um e-mail de confirmação de conta foi enviado para ' . $freelancer->email);
    } else
    {
      $message = parent::returnMessage('danger', 'Usuário não encontrado!');
    }

    return redirect()->route('freelancer.login-view')->with('message', $message);
  }

  public function confirmaConta($token) {
    $freelancer = Freelancer::where('account_confirmation', $token)->first();

    if(count($freelancer) > 0) {
     $freelancer->ativo = 1;
     $freelancer->save();
     $message = parent::returnMessage('success', 'Conta confirmada com sucesso!');

     return redirect()->route('freelancer.login-view')->with('message', $message);
   }

   $message = parent::returnMessage('danger', 'Usuário não encontrado!');

   return redirect()->route('freelancer.login-view')->with('message', $message);
 }
}
