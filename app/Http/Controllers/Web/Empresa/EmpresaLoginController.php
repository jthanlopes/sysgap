<?php

namespace App\Http\Controllers\Web\Empresa;

use App\Empresa;
use App\Utilities\Curl;
use Illuminate\Http\Request;

class EmpresaLoginController extends Controller
{
  public function __construct() {
    $this->middleware('guest:empresa')->except('logout');
  }

  public function loginView() {
    return view('site.login-empresa');
  }

  public function login(Request $request, Curl $curl) {
    $this->validate($request, [
      'email' => 'required|email',
      'password' => 'required|min:6',
      // 'g-recaptcha-response' => 'required|captcha',
    ]);

    $response = json_decode($curl->post('https://www.google.com/recaptcha/api/siteverify', [
      'secret' => config('services.recaptcha.secret'),
      'response' => $request->input('g-recaptcha-response'),
      'remoteip' => $request->ip()
    ]));

    if (!$response->success) {
      abort(400, 'No no no!');
    }

    $empresa = Empresa::where('email', $request->email)->first();

    if (!$empresa) {
      $message = parent::returnMessage('danger', 'E-mail não encontrado!');
      return redirect()->back()->withInput($request->only('email'))->with('message', $message);
    }

    if ($empresa->ativo == 0) {
      $message = parent::returnMessage('info', 'Confirme sua conta antes de continuar.');
    } elseif(auth()->guard('empresa')->attempt(['email' => $request->email, 'password' => $request->password, 'ativo' => 1], $request->remember)) {
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
