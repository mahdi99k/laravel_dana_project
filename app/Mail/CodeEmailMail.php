<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CodeEmailMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $otp;

    public function __construct($otp)
    {
        $this->otp = $otp;
    }

    public function build()
    {
        return $this->view('email')
            ->with(['otp' => $this->otp])
            ->subject('کد تایید دانا');
    }

    //-------------------- default
    /*public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'کد تایید دانا',
        );
    }


    public function content(): Content
    {
        return new Content(
            view: 'email',
        );
    }

    public function attachments(): array
    {
        return [];
    }*/
}
