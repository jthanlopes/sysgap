<?php

namespace App\Http\Controllers\Admin\Mensagem;

use App\Mensagen;
use Illuminate\Http\Request;

class MensagemController extends Controller
{
  public function __construct() {
    $this->middleware('auth:web');
  }

  public function msgView() {
    $msg = Mensagen::where('respondida', 0)->paginate(15);
    return view('admin.mensagem.msg-view', compact('msg'));
  }
}