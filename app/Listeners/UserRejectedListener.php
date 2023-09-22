<?php

namespace App\Listeners;

use App\Events\UserRejected;
use App\Notifications\UserNotApproved;

class UserRejectedListener
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
     * @param UserRejected $event
     *
     * @return void
     */
    public function handle(UserRejected $event)
    {
        // Notify the user
        $event->getUser()->notify(new UserNotApproved());
    }
}
