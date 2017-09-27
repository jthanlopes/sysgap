<?php

namespace App\Http\Controllers\Web\Freelancer;

use App\Freelancer;
use Illuminate\Http\Request;

class FreelancerLoginController extends Controller
{
    public function __construct() {
        $this->middleware('guest:freelancer')->except('logout');
    }

    public function loginView() {
        return view('site.login-freelancer');
    }

    public function login(Request $request) {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (auth()->guard('freelancer')->attempt(['email' => $request->email, 'password' => $request->password, 'ativo' => 1], $request->remember)) {
            return redirect()->route('freelancer.perfil');
        }

        return redirect()->back()->withInput($request->only('email', 'remember'));
    }

    public function logout()
    {
        auth()->guard('freelancer')->logout();
        return redirect('/');
    }
}
