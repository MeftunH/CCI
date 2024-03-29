<?php

namespace App\Mail;

use App\Models\Subscriber;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Summary extends Mailable
{
    use Queueable, SerializesModels;
    public $subscriber;
    public $posts;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Subscriber $subscriber,$posts)
    {
        $this->subscriber = $subscriber;
        $this->posts = $posts;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->from(\App\Models\Mail::where('type',2)->first()->mail)->view('emails.summary');
    }
}
