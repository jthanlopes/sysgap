<?php

namespace App\Http\Controllers\Web\Freelancer;

use App\Empresa;
use Illuminate\Http\Request;

class FreelancerController extends Controller
{
    public function __construct() {
        $this->middleware('auth:freelancer');
    }

    public function perfil() {
        return view('site.freelancer.perfil');
    }
}
