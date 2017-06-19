<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

class AdminLoginController extends Controller
{
    // use AuthenticatesUsers;

	public function __construct() {
		$this->middleware('guest')->except('logout');
	}

    public function showLoginForm() {
    	return view('auth.login-admin');
    }

    public function login(Request $request) {
    	$this->validate($request, [
    		'email' => 'required|email',
    		'password' => 'required|min:6'
    	]);

    	if (auth()->guard('web')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {    		
    		return redirect()->intended(route('admin.dashboard'));
    	}
    	return redirect()->back()->withInput($request->only('email', 'remember'));
    }    

    public function logout()                
    {                                        
        auth()->guard('web')->logout();
        return redirect('/admin');
    }
}
