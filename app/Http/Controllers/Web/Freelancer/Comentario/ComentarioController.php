<?php

namespace App\Http\Controllers\Web\Freelancer\Comentario;

use App\Comentario;
use App\Freelancer;
use App\Job;
use Auth;

use Illuminate\Http\Request;

class ComentarioController extends Controller
{
  public function __construct() {
    $this->middleware('auth:freelancer');
  }

  public function addComentario(Request $request) {
    Comentario::create([
      'comentario' => $request->comentario,
      'job_id' => $request->jobId,
      'freelancer_id' => Auth::user()->id,
    ]);

    $message = parent::returnMessage('success', 'Comentário adicionado com sucesso!');

    return redirect()->back()->with('message', $message);
  }
}
