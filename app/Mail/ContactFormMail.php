<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactFormMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var string
     */
    public $fromEmail;

    /**
     * @var string
     */
    public $fromName;

    /**
     * @var string
     */
    public $text;

    /**
     * Create a new message instance.
     *
     * @param  string  $fromEmail
     * @param  string  $fromName
     * @param  string  $message
     */
    public function __construct(string $fromEmail, string $fromName, string $message)
    {
        $this->fromEmail = $fromEmail;
        $this->fromName = $fromName;
        $this->text = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('contact@wowpuggers.com', 'WoWPuggers')
                    ->text('emails.contact');
    }
}
