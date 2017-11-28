<?php

namespace App\Http\Controllers\Web\Freelancer;

use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Password;
use Auth;


class FreelancerResetPasswordController extends Controller
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
    protected $redirectTo = '/freelancer';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      $this->middleware('guest:freelancer');
    }

    protected function guard() {
      return Auth::guard('freelancer');
    }

    protected function broker() {
      return Password::broker('freelas');
    }

    public function showResetForm(Request $request, $token=null) {
      return view('site.reset-freelancer')->with(
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
      return redirect()->route('freelancer.login')
      ->with('status', 'Senha redefinida com sucesso!');
    }

    protected function sendResetFailedResponse(Request $request, $response)
    {
      return redirect()->back()
      ->withInput($request->only('email'))
      ->withErrors(['email' => 'E-mail não encontrado!']);
    }
  }
