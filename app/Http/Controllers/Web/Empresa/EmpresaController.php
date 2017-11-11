<?php

namespace App\Http\Controllers\Web\Empresa;

use App\Empresa;
use App\Endereco;
use App\Noticia;
use App\Conhecimento;
use Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Storage;

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

        if ($request->profile_photo == null) {
            $empresaOld = Empresa::find($request->empresa);
            $filename = $empresaOld->foto_perfil;
        } else {
            $filename = config('app.name') . '_foto_perfil' . str_slug($request->email, '_') . '_' . $request->file('profile_photo')->getClientOriginalName();
            $request->profile_photo->storeAs('empresas/perfil', $filename, 'public');
        }

        Empresa::where('id', $request->empresa)
        ->update(['nome' => $request->nome,
          'email' => $request->email,
          'cnpj' => $request->cnpj,
          'password' => bcrypt($request->senha),
          'categoria' => $request->get('categoria'),
          'endereco_id' => $request->endereco,
          'foto_perfil' => $filename,
          'ativo' => 1,
          'account_confirmation' => hash_hmac('sha256', str_random(40), config('app.key'))]);

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
