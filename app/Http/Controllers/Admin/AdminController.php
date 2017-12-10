<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Auth;
use App\Admin;
use App\Empresa;
use App\Freelancer;
use App\Mensagen;
use App\Http\Controllers\Controller;
use Charts;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      $this->middleware('auth:web');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $totAgencias = Empresa::where('categoria', 'Agência')->count('id');
      $totProdutoras = Empresa::where('categoria', 'Produtora')->count('id');
      $totOutrasEmpresas = Empresa::where('categoria', 'Empresa')->count('id');
      $totFreelancers = Freelancer::all()->count('id');

      $chart = Charts::create('pie', 'highcharts')
      ->title('Usuários do sistema')
      ->labels(['Agências', 'Produtoras', 'Outras empresas', 'Freelancers'])
      ->values([$totAgencias, $totProdutoras, $totOutrasEmpresas, $totFreelancers])
      ->dimensions(1000,500)
      ->responsive(true);

      //______________________________________________________________________________________________

      $duvidas = Mensagen::where('tipo', 0)->count('id');
      $elogios = Mensagen::where('tipo', 1)->count('id');
      $reclamacoes = Mensagen::where('tipo', 2)->count('id');
      $sugestoes = Mensagen::where('tipo', 3)->count('id');

      $chart2 = Charts::create('donut', 'highcharts')
      ->title('Mensagens recebidas')
      ->labels(['Dúvidas', 'Elogios', 'Reclamações', 'Sugestões'])
      ->values([$duvidas,$elogios,$reclamacoes,$sugestoes])
      ->dimensions(1000,500)
      ->responsive(true);

      return view('admin.home', ['chart' => $chart], ['chart2' => $chart2]);
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

    public function adminPerfilInativo($id) {
      $admin = Admin::find($id);

      return view('admin.admin-perfil-inativo', compact('admin'));
    }

    public function adminPesquisarAtivos(Request $request) {
      $administradores = Admin::orWhere('name', 'like', '%' . $request->pesquisa . '%')->where('active', 1)->get();

      return view('admin.admins-view', compact('administradores'));
    }

    public function adminPesquisarInativos(Request $request) {
      $administradores = Admin::orWhere('name', 'like', '%' . $request->pesquisa . '%')->where('active', 0)->get();

      return view('admin.admins-view-inativos', compact('administradores'));
    }
  }
