<?php

namespace App\Listeners;

use App\Events\UserJoinedHobbyClub;
use App\Mail\MailManagerUserJoinedHobbyClub;
use App\Notifications\UserJoinedHobbyClubNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class NotifyUserJoinedHobbyClub
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserJoinedHobbyClub  $event
     * @return void
     */
    public function handle(UserJoinedHobbyClub $event)
    {
        Mail::send(new MailManagerUserJoinedHobbyClub($event->getUser(), $event->getHobby()));
    }
}
