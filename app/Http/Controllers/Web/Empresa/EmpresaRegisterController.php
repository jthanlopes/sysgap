<?php

namespace App\Http\Controllers\Web\Empresa;

use App\Empresa;
use App\Endereco;
use App\Mail\ConfirmaConta;
use Illuminate\Http\Request;
use Storage;

class EmpresaRegisterController extends Controller
{
  public function __construct() {
    $this->middleware('guest:empresa');
  }

  public function registroView() {
    return view('site.registro-empresa');
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
    $request->profile_photo->storeAs('empresas/perfil', $filename, 'public');

    $empresa = Empresa::create([
      'nome' => $request->nome,
      'email' => $request->email,
      'cnpj' => $request->cnpj,
      'password' => bcrypt($request->senha),
      'categoria' => $request->get('categoria'),
      'endereco_id' => $endereco['id'],
      'foto_perfil' => $filename,
      'ativo' => 0,
      'account_confirmation' => hash_hmac('sha256', str_random(40), config('app.key')),
    ]);

    \Mail::to($empresa)->send(new ConfirmaConta($empresa));

    if ( $empresa )
    {
      $message = parent::returnMessage('info', 'Um e-mail de confirmação de conta foi enviado para ' . $empresa->email);
    } else
    {
      $message = parent::returnMessage('danger', 'Erro ao fazer o registro!');
    }

    return redirect()->route('empresa.login-view')->with('message', $message);
  }

  public function confirmaConta($token) {
    $empresa = Empresa::where('account_confirmation', $token)->first();

    if(count($empresa) > 0) {
     $empresa->ativo = 1;
     $empresa->save();
     $message = parent::returnMessage('success', 'Conta confirmada com sucesso!');

     return redirect()->route('empresa.login-view')->with('message', $message);
   }

   $message = parent::returnMessage('danger', 'Usuário não encontrado!');

   return redirect()->route('empresa.login-view')->with('message', $message);
 }
}