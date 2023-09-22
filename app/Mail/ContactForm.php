<?php

namespace App\Mail;

use App\Contact;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactForm extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var Contact related contact form
     */
    private Contact $contact;

    /**
     * @var User related user
     */
    private User $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Contact $contact, User $user)
    {
        $this->contact = $contact;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return ContactForm
     */
    public function build(): ContactForm
    {
        return $this->to(config('mail-recievers.contact', []))
            ->view('email.contactformsubmitted', [
                'contact' => $this->contact,
                'user' => $this->user,
            ])
            ->subject(
                sprintf('Yeni bir iletişim formu alındı - %s', $this->user->name)
            );
    }
}
