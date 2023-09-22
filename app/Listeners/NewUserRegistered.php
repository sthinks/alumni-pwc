<?php

namespace App\Listeners;

use App\Mail\MailManagerForNewUser;
use Illuminate\Support\Facades\Mail;

class NewUserRegistered
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param $event
     *
     * @return void
     */
    public function handle($event)
    {
        Mail::send(new MailManagerForNewUser());
    }
}
