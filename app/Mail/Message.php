<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Message extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * @var string
     */
    public string $title;
    /**
     * @var string
     */
    public string $message;

    /**
     * Create a new message instance.
     *
     * @param string $title
     * @param string $message
     */
    public function __construct(string $title, string $message)
    {
        //
        $this->title = $title;
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.message');
    }
}
