<?php

namespace App\Mail;

use App\Freelancer;
use Auth;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ConfirmaContaFreelancer extends Mailable
{
    use Queueable, SerializesModels;
    public $freelancer;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Freelancer $freelancer)
    {
        $this->freelancer = $freelancer;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.confirma-conta-freelancer');
    }
}
