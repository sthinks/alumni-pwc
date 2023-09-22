<?php

namespace App\Mail;

use App\Hobby;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailManagerUserJoinedHobbyClub extends Mailable
{
    use Queueable, SerializesModels;

    private string $mail;
    private Hobby $hobby;
    private User $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, Hobby $hobby)
    {
        $this->mail = 'pwc.tr.alumni@pwc.com';
        $this->hobby = $hobby;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return MailManagerUserJoinedHobbyClub
     */
    public function build(): MailManagerUserJoinedHobbyClub
    {
        return $this->to($this->mail)
            ->view('email.manager.newuser')
            ->subject(sprintf(
                "Kullanıcı %s, %s kulübüne kayıt oldu",
                $this->user->name,
                $this->hobby->hobby_title
            ));
    }
}
