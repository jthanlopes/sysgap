<?php

namespace App\Mail;

use App\Empresa;
use Auth;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ConfirmaConta extends Mailable
{
    use Queueable, SerializesModels;
    public $empresa;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Empresa $empresa)
    {
        $this->empresa = $empresa;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {                 
        return $this->view('emails.bem-vindo');
    }
}
