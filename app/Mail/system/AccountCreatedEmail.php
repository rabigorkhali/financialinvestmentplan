<?php

namespace App\Mail\system;

use App\Traits\Mail;
use Cookie;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AccountCreatedEmail extends Mailable
{
    use Queueable, SerializesModels, Mail;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->user = $data;
        $this->locale = Cookie::get('lang');
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $content = $this->parseEmailTemplate([
            '%user_name%' => $this->user->name,
        ], 'AccountCreateEmail', $this->locale);

        return new Content(
            view: 'system.mail.index',
            with: ['content' => $content],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments(): array
    {
        return [];
    }
}
