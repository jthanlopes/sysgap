<?php

namespace App\Http\Controllers\Web\Freelancer;

use App\Freelancer;
use Auth;
use App\Utilities\Curl;
use Illuminate\Http\Request;

class FreelancerLoginController extends Controller
{
  public function __construct() {
    $this->middleware('guest:freelancer')->except('logout');
  }

  public function loginView() {
    return view('site.login-freelancer');
  }

  public function login(Request $request, Curl $curl) {

    $response = json_decode($curl->post('https://www.google.com/recaptcha/api/siteverify', [
      'secret' => config('services.recaptcha.secret'),
      'response' => $request->input('g-recaptcha-response'),
      'remoteip' => $request->ip()
    ]));

    if (!$response->success) {
      abort(400, 'No no no!');
    }

    $this->validate($request, [
      'email' => 'required|email',
      'password' => 'required|min:6'
    ]);

    $freelancer = Freelancer::where('email', $request->email)->first();

    if (!$freelancer) {
      $message = parent::returnMessage('danger', 'E-mail não encontrado!');
      return redirect()->back()->withInput($request->only('email'))->with('message', $message);
    }

    if ($freelancer->ativo == 0) {
      $message = parent::returnMessage('info', 'Confirme sua conta antes de continuar.');
    } elseif(auth()->guard('freelancer')->attempt(['email' => $request->email, 'password' => $request->password, 'ativo' => 1], $request->remember)) {
      return redirect()->route('freelancer.perfil');
    } else {
      $message = parent::returnMessage('danger', 'Senha incorreta! Tente novamente.');
    }

    return redirect()->back()->withInput($request->only('email'))->with('message', $message);
  }

  public function logout()
  {
    auth()->guard('freelancer')->logout();
    return redirect('/');
  }
}
