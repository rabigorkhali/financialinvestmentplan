<?php

namespace App\Mail\system;

use App\Traits\Mail;
use Cookie;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;

class ResendOtpEmail extends Mailable
{
    use Queueable, SerializesModels, Mail;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data, $otpCode)
    {
        $this->user = $data;
        $this->otpCode = $otpCode;
        $this->locale = Cookie::get('lang');
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $content = $this->parseEmailTemplate([
            '%user_name%' => $this->user->name,
            '%otp_code%' => $this->otpCode,
        ], 'ResendOtpCodeEmail', $this->locale);

        return new Content(
            view: 'system.mail.index',
            with: ['content' => $content],
        );
    }
}
