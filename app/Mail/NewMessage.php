<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewMessage extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($sendername,$receivername,$message)
    {
         $this->sender_name = $sendername;
         $this->receiver_name = $receivername;
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
         return $this->from('test4rvtech@gmail.com', "test4rvtech")
                    ->subject('You have received new message')
                    ->view('emails.new_message')
                    ->with(['sendname' => $this->sender_name,'recname'=>$this->receiver_name,'msg'=>$this->message]);
    }
}
