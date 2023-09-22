<?php

namespace App\Listeners;

use App\Events\NewJobShared;
use App\Mail\MailManagerForNewJobShare;
use Illuminate\Support\Facades\Mail;

class SendNewJobSharedNotification
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
     * @param NewJobShared $event
     *
     * @return void
     */
    public function handle(NewJobShared $event)
    {
        Mail::send(new MailManagerForNewJobShare());
    }
}
