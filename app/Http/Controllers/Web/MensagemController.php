<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Mensagen;
use App\Freelancer;
use App\Empresa;
use Auth;

class MensagemController extends Controller
{
  public function envia(Request $request) {
    if (auth()->guard('empresa')->check()) {
      Mensagen::create([
        'mensagem' => $request->msg,
        'tipo' => $request->get('tipo'),
        'empresa_remetente' => Auth::guard('empresa')->user()->id,
        'email_remetente' => $request->email,
        'nome_remetente' => $request->nome,
        'respondida' => 0,
      ]);
    } elseif (auth()->guard('freelancer')->check()) {
      Mensagen::create([
        'mensagem' => $request->msg,
        'tipo' => $request->get('tipo'),
        'freelancer_remetente' => Auth::guard('freelancer')->user()->id,
        'email_remetente' => $request->email,
        'nome_remetente' => $request->nome,
        'respondida' => 0,
      ]);
    } else {
      Mensagen::create([
        'mensagem' => $request->msg,
        'tipo' => $request->get('tipo'),
        'email_remetente' => $request->email,
        'nome_remetente' => $request->nome,
        'respondida' => 0,
      ]);
    }

    $message = parent::returnMessage('success', 'Mensagem enviada ao administrador, a resposta será enviada por e-mail!');

    return redirect()->back()->with('message', $message);
  }
}