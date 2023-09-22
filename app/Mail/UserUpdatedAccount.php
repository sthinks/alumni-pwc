<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\User;

class UserUpdatedAccount extends Mailable
{
    use Queueable, SerializesModels;
    
    private User $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->to(config('mail-recievers.contact', []))
        ->view('email.manager.updatedaccount', [
            'user' => $this->user,
        ])
        ->subject(
            sprintf('Kullanıcı profil bilgilerini güncelledi - %s', $this->user->name)
        );
    }
}
