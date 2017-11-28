<?php

namespace App\Http\Controllers\Web\Empresa;

use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Password;
use Auth;


class EmpresaResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/empresa';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      $this->middleware('guest:empresa');
    }

    protected function guard() {
      return Auth::guard('empresa');
    }

    protected function broker() {
      return Password::broker('empresas');
    }

    public function showResetForm(Request $request, $token=null) {
      return view('site.reset-empresa')->with(
        ['token' => $token, 'email' => $request->email]
      );
    }

    protected function resetPassword($user, $password)
    {
      $user->forceFill([
        'password' => bcrypt($password),
        'remember_token' => Str::random(60),
      ])->save();
    }

    protected function sendResetResponse($response)
    {
      return redirect()->route('empresa.login')
      ->with('status', 'Senha redefinida com sucesso!');
    }

    protected function sendResetFailedResponse(Request $request, $response)
    {
      return redirect()->back()
      ->withInput($request->only('email'))
      ->withErrors(['email' => 'E-mail não encontrado!']);
    }
  }
