<?php

namespace App\Http\Controllers\Web\Empresa;

use App\Empresa;
use App\Endereco;
use Illuminate\Http\Request;
use Storage;

class EmpresaRegisterController extends Controller
{
    public function __construct() {
        $this->middleware('guest:empresa');
    }

    public function empresaNovo(Request $request) {        
        $endereco = Endereco::create([
            'cep' => request('cep'), 
            'logradouro' => request('logradouro'), 
            'numero' => request('numero'),
            'complemento' => request('complemento'),
            'bairro' => request('bairro'),
            'cidade' => request('cidade'),
            'uf' => request('uf'),
        ]);

        // Salvar o endereço primeiro
        $endereco->save();    

        // $filename = config('app.name') . '_foto_perfil_' . $request->id . str_slug($request->name, '_') . '.' . $request->profile_photo .'.png';
        // $request->profile_photo->storeAs('empresas/perfil', $filename, 'public');

        $empresa = Empresa::create([
            'nome' => $request->nome,
            'email' => $request->email, 
            'cnpj' => $request->cnpj,
            'password' => bcrypt($request->password),
            'categoria' => $request->categoria,
            'endereco_id' => $endereco['id'],
            'foto_perfil' => 'teste',
            'ativo' => 1,
        ]);

        // Salva a empresa
        $empresa->save();

        return redirect('/');
    }
}
