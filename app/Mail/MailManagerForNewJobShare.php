<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailManagerForNewJobShare extends Mailable
{
    use Queueable, SerializesModels;

    private string $mail;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->mail = 'pwc.tr.alumni@pwc.com';
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): MailManagerForNewJobShare
    {
        return $this->to($this->mail)
            ->view('email.manager.newjobshare')
            ->subject('Yeni bir iş ilanı paylaşıldı.');
    }
}
