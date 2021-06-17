<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResumeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $mailData;
    public $file;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mailData,$file)
    {
        $this->mailData = $mailData;
        $this->file = $file;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): ResumeMail
    {
        return $this->markdown('emails.resumeMail')
            ->with('mailData', $this->mailData)->attach($this->file);
    }
}
