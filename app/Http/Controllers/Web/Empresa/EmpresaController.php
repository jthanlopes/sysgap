<?php

namespace App\Http\Controllers\Web\Empresa;

use App\Empresa;
use App\Endereco;
use Illuminate\Http\Request;

class EmpresaController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function empresaNovo(Request $request) {
        $endereco = Endereco::create([
            'cep' => request('cep'), 
            'logradouro' => request('logradouro'), 
            'numero' => request('numero'),
            'complemento' => request('complemento'),
            'bairro' => request('bairro'),
            'cidade' => request('cidade'),
            'uf' => request('uf')
        ]);

        $endereco->save();
    }
}
