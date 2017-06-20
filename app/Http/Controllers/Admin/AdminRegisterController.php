<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Auth;

use Storage;

class AdminRegisterController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showRegisterForm() {        
        return view('auth.register-admin');
    }

    public function register(Request $request) {    	
        // Validator::make([
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|string|email|max:255|unique:admins',
        //     'password' => 'required|string|min:6|confirmed',
        //     // 'profile_photo' => 'required|image',
        // ]);
        $filename = config('app.name') . '_foto_perfil_' . str_slug(Auth::user()->name, '_') . '.' . $request->profile_photo->getClientOriginalExtension();
        $request->profile_photo->storeAs('admins/perfil', $filename, 'public');

    	Admin::updateOrCreate([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'active' => 1,
            'profile_photo' => $filename,
            // 'profile_photo' => $data['profile_photo'],
        ]);        

        return redirect()->route('admins.view')->with('message', 'Registro efetuado com sucesso!');
    }
}
