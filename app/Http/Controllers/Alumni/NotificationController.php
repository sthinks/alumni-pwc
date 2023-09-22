<?php

namespace App\Http\Controllers\Alumni;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class NotificationController extends Controller
{
    /**
     * Mark notifications read
     *
     * @param string $notification_id
     *
     * @return RedirectResponse
     */
    public function handle(string $notification_id): RedirectResponse
    {
        // find or fail the notification notifications
        $notification = auth()->user()->notifications()->findOrFail($notification_id);

        // mark the notification as read
        if ($notification->unread()) {
            $notification->markAsRead();
        }

        // get notification data
        $notification_data = $notification->data;

        // if link not provided
        // redirect to the alumni dashboard
        if (! array_key_exists('link', $notification_data)) {
            return redirect()->route('home');
        }

        // redirect to the link
        return redirect($notification_data['link']);
    }
}
