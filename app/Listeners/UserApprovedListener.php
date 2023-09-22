<?php

namespace App\Listeners;

use App\Events\UserApproved;
use App\Notifications\VerifyUserEmailNotification;

class UserApprovedListener
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
     * @param UserApproved $event
     *
     * @return void
     */
    public function handle(UserApproved $event)
    {
        // notify user
        $event->getUser()->notify(new \App\Notifications\UserApproved());
        // send mail verification
        $event->getUser()->notify(new VerifyUserEmailNotification());
    }
}
