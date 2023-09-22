<?php

namespace App\Listeners;

use App\Events\ProfileUpdated;
use App\Services\Crm\RestCrmIntegration;

class SendCrmUpdate
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
     * @param ProfileUpdated $event
     *
     * @return void
     */
    public function handle(ProfileUpdated $event)
    {
        $user = $event->getUser();
        if ($user->staff_id) {
            (new RestCrmIntegration())->updateUser($user);
        }
    }
}
