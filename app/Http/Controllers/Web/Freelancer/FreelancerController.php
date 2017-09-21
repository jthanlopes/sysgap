<?php

namespace App\Http\Controllers\Web\Freelancer;

use App\Freelancer;
use Auth;
use Illuminate\Http\Request;

class FreelancerController extends Controller
{
  public function __construct() {
    $this->middleware('auth:freelancer');
  }

  public function perfil() {
    $id = Auth::user()->id;
    $freelancer = Freelancer::find($id);
    return view('site.freelancer.perfil', compact('freelancer'));    
  }
}
