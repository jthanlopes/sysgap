<?php

namespace App\Http\Controllers\Web\Freelancer;

use App\Freelancer;
use App\Endereco;
use App\Mail\ConfirmaContaFreelancer;
use Illuminate\Http\Request;
use Storage;
use Validator;

class FreelancerRegisterController extends Controller
{
  public function __construct() {
    $this->middleware('guest:freelancer');
  }

  public function registroView() {
    return view('site.registro-freelancer');
  }

  public function novo(Request $request) {
    $messages = [
      'min'    => 'Senha deve tem no minímo seis caracteres!',
      'required' => 'Preencha o campo :attribute!',
      'profile_photo.required' => 'Adicione uma foto para o seu perfil!',
      'email' => 'Formato do e-mail esta incorreto!',
      'confirmed' => 'Senha e confirmação de senha são diferentes!',
      'unique' => 'Este e-mail já esta cadastrado!'
    ];

    $validator = Validator::make($request->all(), [
      'nome' => 'required',
      'email' => 'required|unique:freelancers',
      'senha' => 'required|min:6',
      'cpf' => 'required',
      'profile_photo' => 'required',
      'cep' => 'required',
      'logradouro' => 'required',
      'numero' => 'required',
      'bairro' => 'required',
      'cidade' => 'required',
      'uf' => 'required',
    ], $messages);

    if ($validator->fails()) {
      return redirect()->back()
      ->withErrors($validator)
      ->withInput();
    }

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
      'password' => bcrypt($request->password),
      'foto_perfil' => $filename,
      'endereco_id' => $endereco['id'],
      'ativo' => 0,
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
