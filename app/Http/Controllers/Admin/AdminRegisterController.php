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
        $this->middleware('auth:web');
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

        $filename = config('app.name') . '_foto_perfil_' . str_slug($request->email, '_') . '_' . $request->file('profile_photo')->getClientOriginalName();
        $request->profile_photo->storeAs('admins/perfil', $filename, 'public');

    	$create = Admin::updateOrCreate([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'active' => 1,
            'profile_photo' => $filename,
        ]);        

        if ( $create )
        {
            $message = parent::returnMessage('success', 'Administrador criado com sucesso!'); 
        } else
        {
            $message = parent::returnMessage('danger', 'Erro ao criar o administrador!');
        }
        
        return redirect()->route('admins.view')->with('message', $message);
    }

    public function adminEditarPerfil(Request $request) {
        // $this->validate($request, [
        //     'titulo' => 'required|max:15',
        //     'nivel'  => 'required',
        // ]);        

        $filename = config('app.name') . '_foto_perfil_' . str_slug($request->email, '_') . '_' . $request->file('profile_photo')->getClientOriginalName();
        $request->profile_photo->storeAs('admins/perfil', $filename, 'public');        

        $update = Admin::where( 'id', Auth::id() )
                                ->update([
                                    'name' => $request->name,
                                    'email' => $request->email,
                                    'password' => bcrypt($request->password),
                                    'active' => 1,
                                    'profile_photo' => $filename,
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

    public function adminEditarPerfilInativo(Request $request) {
        // $this->validate($request, [
        //     'titulo' => 'required|max:15',
        //     'nivel'  => 'required',
        // ]);

        $filename = config('app.name') . '_foto_perfil_' . str_slug($request->email, '_') . '.' . $request->file('profile_photo')->getClientOriginalName();      
        $request->profile_photo->storeAs('admins/perfil', $filename, 'public');

        $update = Admin::where( 'id', $request->id )
                                ->update([
                                    'name' => $request->name,
                                    'email' => $request->email,
                                    'password' => bcrypt($request->password),
                                    'active' => 0,
                                    'profile_photo' => $filename,
                                ]);

        if ( $update )          
        {            
            $message = parent::returnMessage('success', 'Perfil alterado com sucesso!');        
        } else 
        {
            $message = parent::returnMessage('danger', 'Erro ao alterar o perfil!');
        }
        
        return redirect()->route('admins.view-inativos')->with('message', $message);
    }

    public function adminInativar($admin) {
        $update = Admin::where( 'id', $admin )
                                ->update([                                    
                                    'active' => 0,  
                                ]);

        if ( $update )
        {
            $message = parent::returnMessage('success', 'Administrador inativado com sucesso!');
        } else 
        {
            $message = parent::returnMessage('danger', 'Erro ao inativar adiministrador!');
        }

        return redirect()->route('admins.view')->with('message', $message);
    }

    public function adminAtivar($admin) {
        $update = Admin::where( 'id', $admin )
                                ->update([                                    
                                    'active' => 1,  
                                ]);

        if ( $update )
        {
            $message = parent::returnMessage('success', 'Administrador ativado com sucesso!');
        } else 
        {
            $message = parent::returnMessage('danger', 'Erro ao ativar adiministrador!');
        }

        return redirect()->route('admins.view-inativos')->with('message', $message);
    }
}
