<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MessageSignup extends Mailable
{
    use Queueable, SerializesModels;

    public $username;
    public $password;
    public $activation_link;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($username, $password, $activation_link)
    {
        $this->username = $username;
        $this->password = $password;
        $this->activation_link = $activation_link;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.message.signup');
    }
}
