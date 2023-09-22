<?php

namespace App\Listeners;

use App\User;
use Illuminate\Http\Request;

class LogLockout
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
        if ($event->request->has('email')) {
            $user = User::where('email', $event->request->input('email'))->first();
            if ($user) {
                activity(config('activitylog.auth_logs.name'))
                    ->performedOn($user)
                    ->withProperties([
                        'ip' => $this->request->ip(),
                        'user_agent' => $this->request->userAgent(),
                    ])
                    ->log(config('activitylog.auth_logs.lockout'));
            }
        }
    }
}
