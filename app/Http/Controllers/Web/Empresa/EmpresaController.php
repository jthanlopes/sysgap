<?php

namespace App\Http\Controllers\Web\Empresa;

use App\Empresa;
use App\Endereco;
use App\Noticia;
use App\Conhecimento;
use Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;

class EmpresaController extends Controller
{
    public function __construct() {
        $this->middleware('auth:empresa');
        Carbon::setLocale('pt-br');
    }

    public function perfil() {
        $id = Auth::user()->id;
        $empresa = Empresa::find($id);
        $noticias = Noticia::orderBy('created_at', 'desc')->where('empresa_id', $id)->paginate(10);
        return view('site.empresa.perfil', compact('empresa', 'noticias'));
    }

    public function editarPerfil() {
        $id = Auth::user()->id;
        $empresa = Empresa::find($id);

        return view('site.empresa.perfil-editar', compact('empresa'));
    }

    public function editarInfomacoes(Request $request) {
        Endereco::where('id', $request->enderecoId)
        ->update(['cep' => $request->cep,
            'logradouro' => $request->logradouro,
            'numero' => $request->numero,
            'complemento' => $request->complemento,
            'bairro' => $request->bairro,
            'cidade' => $request->cidade,
            'uf' => $request->uf]);

        $message = parent::returnMessage('success', 'Informações editadas com sucesso!');

        return redirect()->route('empresa.editar-perfil.view')->with('message', $message);
    }

    public function editarEndereco(Request $request) {
        Endereco::where('id', $request->enderecoId)
        ->update(['cep' => $request->cep,
            'logradouro' => $request->logradouro,
            'numero' => $request->numero,
            'complemento' => $request->complemento,
            'bairro' => $request->bairro,
            'cidade' => $request->cidade,
            'uf' => $request->uf]);

        $message = parent::returnMessage('success', 'Endereço editado com sucesso!');

        return redirect()->route('empresa.editar-perfil.view')->with('message', $message);
    }
}
