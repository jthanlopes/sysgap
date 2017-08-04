<?php

namespace App\Http\Controllers\Web\Empresa;

use App\Empresa;
use Illuminate\Http\Request;

class EmpresaLoginController extends Controller
{
    public function __construct() {
        $this->middleware('guest:empresa')->except('logout');
    }

    public function loginEmpresa(Request $request) {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6'
            ]);

        if (auth()->guard('empresa')->attempt(['email' => $request->email, 'password' => $request->password, 'ativo' => 1], $request->remember)) { 
            return redirect()->route('empresa.perfil');
        }

        return redirect()->back()->withInput($request->only('email', 'remember'));
    }    

    public function logout()                
    {                                        
        auth()->guard('empresa')->logout();
        return redirect('/');
    }
}
