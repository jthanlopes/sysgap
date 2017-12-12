<?php

namespace App\Http\Controllers\Admin\Freelancer;

use App\Freelancer;
use Illuminate\Http\Request;

class FreelancerController extends Controller
{
  public function __construct() {
    $this->middleware('auth:web');
  }

  public function freelancersView() {
    $freelancers = Freelancer::where('ativo', '=', 1)->orderBy('created_at')->get();
    return view('admin.freelancer.freelancers-view', compact('freelancers'));
  }
}