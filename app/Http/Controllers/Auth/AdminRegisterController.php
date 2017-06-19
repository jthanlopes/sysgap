<?php

namespace App\Http\Controllers\Auth;

use App\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Auth;

class AdminRegisterController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showRegisterForm() {        
        return view('auth.register-admin');
    }

    public function register() {    	
        // Validator::make([
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|string|email|max:255|unique:admins',
        //     'password' => 'required|string|min:6|confirmed',
        //     // 'profile_photo' => 'required|image',
        // ]);

    	Admin::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => bcrypt(request('password')),
            'active' => 1,
            'profile_photo' => 'Jonathan',
            // 'profile_photo' => $data['profile_photo'],
        ]);        

        return redirect()->route('admins.view')->with('message', 'Registro efetuado com sucesso!');
    }
}
