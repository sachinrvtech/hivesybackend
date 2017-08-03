<?php

namespace App\Mail;

use App\Http\Models\School;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewPassword extends Mailable
{
    use Queueable, SerializesModels;
    public $newGeneratedPassword;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user,$newGeneratedPassword)
    {
        $this->user = $user;
        $this->new_password = $newGeneratedPassword;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('no_reply@hivesy.com', "Hivesy")
                    ->subject('New password For Hivesy App')
                    ->view('emails.new_password')
                    ->with(['user_name'=>$this->user->username,'password'=>$this->new_password]);
    }
}
