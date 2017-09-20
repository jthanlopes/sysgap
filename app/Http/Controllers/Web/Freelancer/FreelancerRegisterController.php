<?php

namespace App\Http\Controllers\Web\Freelancer;

use App\Freelancer;
use App\Endereco;
use Illuminate\Http\Request;
use Storage;

class FreelancerRegisterController extends Controller
{
    public function __construct() {
        $this->middleware('guest:freelancer');
    }

    public function novo(Request $request) {   
        // $endereco = Endereco::create([
        //     'cep' => request('cep'),
        //     'logradouro' => request('logradouro'),
        //     'numero' => request('numero'),
        //     'complemento' => request('complemento'),
        //     'bairro' => request('bairro'),
        //     'cidade' => request('cidade'),
        //     'uf' => request('uf'),
        // ]);

        // // Salvar primeiramente o endereço
        // $endereco->save();
        $filename = config('app.name') . '_foto_perfil' . str_slug($request->email, '_') . '_' . $request->file('profile_photo')->getClientOriginalName();
        $request->profile_photo->storeAs('freelancers/perfil', $filename, 'public');

        $empresa = Freelancer::create([
            'nome' => $request->nome,
            'email' => $request->email,
            'cpf' => $request->cpf,
            'password' => bcrypt($request->senha),
            // 'endereco_id' => $endereco['id'],
            'foto_perfil' => $filename,
            'ativo' => 1,
        ]);

        // Salva a empresa
        $empresa->save();

        return redirect('/');
    }
}
