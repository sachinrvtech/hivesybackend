<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewRegisteration extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user,$confirmaton_code)
    {
        $this->user = $user;
        $this->confirmation_code=$confirmaton_code;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('no_reply@givitupshop.com', "GIVITUP")
                    ->subject('Thanks for using GIVITUP | Confirm your email')
                    ->view('emails.emailverification')
                    ->with(['user_name'=>$this->user->name,'confirmation_code'=>$this->confirmation_code]);
    }
}
