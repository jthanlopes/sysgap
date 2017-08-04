<?php

namespace App\Http\Controllers\Web\Empresa;

use App\Empresa;
use Illuminate\Http\Request;

class EmpresaController extends Controller
{
    public function __construct() {
        $this->middleware('auth:empresa');
    }

    public function perfil() {
        return view('site.empresa.empresa-perfil');
    }
}
