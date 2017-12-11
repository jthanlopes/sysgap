<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

use Auth;

class AdminLoginController extends Controller
{

	public function __construct() {
		$this->middleware('guest:web')->except('logout');
	}

    public function showLoginForm() {
    	return view('auth.login-admin');
    }

    public function login(Request $request) {
    	$messages = [
          'min'    => 'Senha deve tem no minímo seis caracteres!',
          'required' => 'Preencha o campo :attribute!',
          'password.required' => 'Preencha o campo senha!',
          'email' => 'Formato do e-mail esta incorreto!',
      ];

      $validator = Validator::make($request->all(), [
          'email' => 'required|email',
          'password' => 'required|min:6',
      ], $messages);

      if ($validator->fails()) {
          return redirect()->back()
          ->withErrors($validator)
          ->withInput();
      }

      if (auth()->guard('web')->attempt(['email' => $request->email, 'password' => $request->password, 'active' => 1], $request->remember)) {
          return redirect()->intended(route('admin.dashboard'));
      }

      $message = parent::returnMessage('danger', 'Confira seu e-mail e senha!');

      return redirect()->back()->withInput($request->only('email', 'remember'))->with('message', $message);
  }

  public function logout()
  {
    auth()->guard('web')->logout();
    return redirect('/admin');
}
}
