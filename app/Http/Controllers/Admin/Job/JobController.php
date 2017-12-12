<?php

namespace App\Http\Controllers\Admin\Job;

use App\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
  public function __construct() {
    $this->middleware('auth:web');
  }

  public function jobsView() {
    $jobs = Job::orderBy('created_at')->get();
    return view('admin.job.jobs-view', compact('jobs'));
  }
}