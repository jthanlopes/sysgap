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

    public function novo(Request $request) {   
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

        $filename = config('app.name') . '_foto_perfil' . str_slug($request->email, '_') . '.' . $request->file('profile_photo')->getClientOriginalName();
        $request->profile_photo->storeAs('empresas/perfil', $filename, 'public');

        $empresa = Empresa::create([
            'nome' => $request->nome,
            'email' => $request->email,
            'cnpj' => $request->cnpj,
            'password' => bcrypt($request->senha),
            'categoria' => $request->get('categoria'),
            'endereco_id' => $endereco['id'],
            'foto_perfil' => $filename,
            'ativo' => 1,
        ]);

        // Salva a empresa
        $empresa->save();

        return redirect('/');
    }
}
