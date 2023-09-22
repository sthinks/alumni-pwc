<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BusinessMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var User Token reciever
     */
    private User $user;

    /**
     * @var string Generated token
     */
    private string $token;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, string $token)
    {
        $this->user = $user;
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): BusinessMail
    {
        return $this->to($this->user->second_mail)
            ->view('email.verification.secondmail', [
                'token' => $this->token,
                'user' => $this->user,
            ])
            ->subject('İş email adresinizi doğrulayın.');
    }
}
