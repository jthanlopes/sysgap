<?php

namespace App\Http\Controllers\Web\Empresa;

use App\Empresa;
use Illuminate\Http\Request;

class EmpresaLoginController extends Controller
{
  public function __construct() {
    $this->middleware('guest:empresa')->except('logout');
  }

  public function loginView() {
    return view('site.login-empresa');
  }

  public function login(Request $request) {
    $this->validate($request, [
      'email' => 'required|email',
      'password' => 'required|min:6'
    ]);

    $empresa = Empresa::where('email', $request->email)->first();

    if (!$empresa) {
      $message = parent::returnMessage('danger', 'E-mail não encontrado!');
      return redirect()->back()->withInput($request->only('email'))->with('message', $message);
    }
    if (auth()->guard('empresa')->attempt(['email' => $request->email, 'password' => $request->password, 'ativo' => 1], $request->remember)) {
      return redirect()->route('empresa.perfil');
    } else {
      $message = parent::returnMessage('danger', 'Senha incorreta! Tente novamente.');
    }
    
    return redirect()->back()->withInput($request->only('email'))->with('message', $message);
  }

  public function logout()
  {                 
    auth()->guard('empresa')->logout();
    return redirect('/');
  }
}
