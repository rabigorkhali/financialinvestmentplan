<?php

namespace App\Mail\system;

use App\Traits\Mail;
use Cookie;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;

class TwoFAEmail extends Mailable
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
            '%verification_code%' => session()->get('verification_code'),
        ], 'TwoFAEmail', $this->locale);

        return new Content(
            view: 'system.mail.index',
            with: ['content' => $content],
        );
    }
}
