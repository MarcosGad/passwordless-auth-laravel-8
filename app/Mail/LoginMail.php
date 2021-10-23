<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LoginMail extends Mailable
{
    use Queueable, SerializesModels;

    public $token;

  
    public function __construct($token)
    {
        $this->token = $token;
    }

 
    public function build()
    {
        return $this->view('loginMail')
            ->subject('Click on the link to login.')
            ->with('token', $this->token);
    }
}