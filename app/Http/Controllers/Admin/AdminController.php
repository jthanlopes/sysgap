<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Auth;
use App\Admin;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {        
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.home');
    }   

    public function adminsView() {
        $administradores = Admin::where('active', 1)->orderBy('active', 'desc')->get();

        return view('admin.admins-view', compact('administradores'));
    }

    public function adminsViewInativos() {
        $administradores = Admin::where('active', 0)->get();

        return view('admin.admins-view-inativos', compact('administradores'));
    }

    public function adminPerfil() {
        $id = Auth::user()->id;
        $admin = Admin::find($id);

        return view('admin.admin-perfil', compact('admin'));
    }

    public function adminPesquisarAtivos(Request $request) {
        $administradores = Admin::orWhere('name', 'like', '%' . $request->pesquisa . '%')->orderBy('active', 'desc')->get();

        return view('admin.admins-view', compact('administradores'));
    }

    public function adminPesquisarInativos(Request $request) {
        $administradores = Admin::orWhere('name', 'like', '%' . $request->pesquisa . '%')->where('active', 0)->get();

        return view('admin.admins-view-inativos', compact('administradores'));
    }
}
