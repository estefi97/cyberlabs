<?php


namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserRegistered extends Mailable
{

    use Queueable, SerializesModels;


    public $user;
    public $userPasswordNoHash;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $userPasswordNoHash)
    {
        $this->user = $user;
        $this->userPasswordNoHash = $userPasswordNoHash;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(__("Bienvenid@ a Cyberlabs!"))->markdown('emails.user_registered');
    }

}