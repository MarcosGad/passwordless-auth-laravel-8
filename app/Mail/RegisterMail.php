<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegisterMail extends Mailable
{
    use Queueable, SerializesModels;

    public $token;

   
    public function __construct($token)
    {
        $this->token = $token;
    }

  
    public function build()
    {
        return $this->view('registerMail')
            ->subject('Email verification mail.')
            ->with('token', $this->token);
    }
}