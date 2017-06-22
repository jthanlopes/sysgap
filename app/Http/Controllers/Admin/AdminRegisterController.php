<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
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
        $filename = config('app.name') . '_foto_perfil_' . $request->id . str_slug($request->name, '_') . '.' . $request->profile_photo->getClientOriginalExtension();
        $request->profile_photo->storeAs('admins/perfil', $filename, 'public');

    	Admin::updateOrCreate([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'active' => 1,
            'profile_photo' => $filename,            
        ]);        

        return redirect()->route('admins.view')->with('message', 'Registro efetuado com sucesso!');
    }

    public function adminEditarPerfil(Request $request) {
        // $this->validate($request, [
        //     'titulo' => 'required|max:15',
        //     'nivel'  => 'required',
        // ]);

        $update = Admin::where( 'id', Auth::id() )
                                ->update([
                                    'name' => $request->name,
                                    'email' => $request->email,
                                    'password' => bcrypt($request->password),
                                    'active' => 1,
                                    // 'profile_photo' => $filename,
                                ]);

        if ( $update )          
        {            
            $message = parent::returnMessage('success', 'Perfil alterado com sucesso!');            
        } else 
        {
            $message = parent::returnMessage('danger', 'Erro ao alterar o perfil!');
        }
        
        return redirect()->route('admins.view')->with('message', $message);
    }

    // public function conhecimentoExcluir(Conhecimento $conhecimento) {
    //     $exclusao = $conhecimento->delete();

    //     if ( $exclusao )
    //     {
    //         $message = parent::returnMessage('success', 'Exclusão efetuada com sucesso!');
    //     } else 
    //     {
    //         $message = parent::returnMessage('danger', 'Erro ao fazer a exclusão!');
    //     }

    //     return redirect()->route('conhecimentos.view')->with('message', $message);
    // }
}
