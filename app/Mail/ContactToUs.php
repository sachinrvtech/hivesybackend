<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactToUs extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user,$postdata)
    {
        $this->user=$user;
        $this->subject=$postdata['subject'];
        $this->msg=$postdata['message'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('no_reply@givitupshop.com', "GIVITUP")
                    ->subject($this->subject)
                    ->view('emails.contactus')
                    ->with(['user_name'=>$this->user->name,'subject'=>$this->subject,'msg'=>$this->msg,'email'=>$this->user->email]);
    }
}
