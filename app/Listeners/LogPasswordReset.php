<?php

namespace App\Listeners;

use Illuminate\Http\Request;

class LogPasswordReset
{
    /**
     * The request.
     *
     * @var Request
     */
    private Request $request;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
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
        if ($event->user) {
            activity(config('activitylog.auth_logs.name'))
                ->performedOn($event->user)
                ->withProperties([
                    'ip' => $this->request->ip(),
                    'user_agent' => $this->request->userAgent(),
                ])
                ->log(config('activitylog.auth_logs.password_reset'));
        }
    }
}
