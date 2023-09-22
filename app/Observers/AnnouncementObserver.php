<?php

namespace App\Observers;

use App\Announcement;

class AnnouncementObserver
{
    /**
     * Handle the announcement "creating" event.
     *
     * @param Announcement $announcement
     * @return void
     */
    public function creating(Announcement $announcement)
    {
        $announcement->announcement_edit_by = auth()->id();
    }
}
