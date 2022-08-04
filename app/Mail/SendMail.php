<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    public $emailSubject = "";
    public $emailBody = "";
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($emailSubject, $emailBody)
    {
        $this->emailSubject = $emailSubject;
        $this->emailBody = $emailBody;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->subject($this->emailSubject);
        return $this->view('emails.blueprint');
    }
}
