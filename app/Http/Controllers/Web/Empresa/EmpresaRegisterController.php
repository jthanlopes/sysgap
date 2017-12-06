<?php

namespace App\Http\Controllers\Web\Empresa;

use App\Empresa;
use App\Endereco;
use App\Mail\ConfirmaConta;
use Validator;
use Illuminate\Http\Request;
use Storage;
use Pontuacoe;
use Mail;

class EmpresaRegisterController extends Controller
{
  public function __construct() {
    $this->middleware('guest:empresa');
  }

  public function registroView() {
    return view('site.registro-empresa');
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
      'email' => 'required|unique:empresas',
      'senha' => 'required|min:6|confirmed',
      'cnpj' => 'required',
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
      'pontuacao' => 100,
      'account_confirmation' => hash_hmac('sha256', str_random(40), config('app.key')),
    ]);

    \Mail::to($empresa)->send(new ConfirmaConta($empresa));

    $pontuacaoId = 1;

    $empresa->pontuacoes()->attach($pontuacaoId, ['created_at' => new \DateTime(), 'updated_at' => new \DateTime()]);

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

     $verificaPontuacao = $empresa->pontuacoes()->where('pontuacoe_id', 2)->count();

     if($verificaPontuacao == 0) {
      $pontuacaoId = 2;

      $empresa->pontuacoes()->attach($pontuacaoId, ['created_at' => new \DateTime(), 'updated_at' => new \DateTime()]);

      $total = $empresa->pontuacoes->sum('valor');
      $empresa->pontuacao = $total;
      $empresa->save();
    }

    return redirect()->route('empresa.login-view')->with('message', $message);
  }
}
}