<?php

namespace App\Observers;

use App\Announcement;
use App\AnnouncementCategory;
use App\Event;

class EventObserver
{
    /**
     * Handle the event "creating" event.
     *
     * @param Event $event
     * @return void
     */
    public function creating(Event $event)
    {
        $event->event_edit_by = auth()->id();
    }

    /**
     * Handle the campaign "created" event.
     *
     * @param Event $event
     * @return void
     */
    public function created(Event $event)
    {
        // push an announcement
        $announcement = AnnouncementCategory::where('id', 6)->get();
        if ($announcement->count() === 1 && !$event->event_is_private) {
            Announcement::create([
                'announcement_title' => $event->event_title,
                'announcement_category_id' => $announcement->first()->id,
                'announcement_poster' => $event->event_poster,
                'announcement_link' => route('events.show', $event->event_seo_url),
            ]);
        }
    }
}
