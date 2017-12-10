<?php

namespace App\Http\Controllers\Admin\Grafico;

use App\Empresa;
use App\Freelancer;
use Charts;

class GraficoController extends Controller
{
  public function __construct() {
    $this->middleware('auth:web');
}

public function graficosCadastros() {
    // to display a specific year, pass the parameter. For example to display the months of 2016 and display a fancy output label:
    $chart = Charts::database(Freelancer::all(), 'bar', 'highcharts')
    ->title('Cadastros de freelancers')
    ->elementLabel("Total")
    ->dimensions(1000, 500)
    ->responsive(true)
    ->groupByMonth('2017', true);

    // to display a specific year, pass the parameter. For example to display the months of 2016 and display a fancy output label:
    $chart2 = Charts::database(Empresa::all(), 'bar', 'highcharts')
    ->title('Cadastros de empresas')
    ->elementLabel("Total")
    ->dimensions(1000, 500)
    ->responsive(true)
    ->groupByMonth('2017', true);

    $totFreelancers = Freelancer::all()->count('id');
    $totEmpresas = Empresa::all()->count('id');

    $totUsuarios = $totFreelancers + $totEmpresas;

    $totFreelancersAtivos = Freelancer::where('ativo', 1)->get()->count('id');
    $totEmpresasAtivas = Empresa::where('ativo', 1)->get()->count('id');

    $totAtivos = $totFreelancersAtivos + $totEmpresasAtivas;

    $chart3 = Charts::create('percentage', 'justgage')
    ->title('Usuários ativos')
    ->elementLabel('Usuários')
    ->values([$totAtivos,0,$totUsuarios])
    ->responsive(true)
    ->height(500)
    ->width(1000);

    $tipo = "cadastros";

    return view('admin.grafico.graficos-view', ['chart' => $chart, 'chart2' => $chart2, 'chart3' => $chart3, 'tipo' => $tipo]);
}
}