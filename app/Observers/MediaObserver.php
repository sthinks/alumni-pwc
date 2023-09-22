<?php

namespace App\Observers;

use App\Announcement;
use App\AnnouncementCategory;
use App\Media;

class MediaObserver
{


    /**
     * Handle the media "created" event.
     *
     * @param Media $media
     * @return void
     */
    public function created(Media $media)
    {
        // push an announcement
        $announcement = AnnouncementCategory::where('id', 1)->get();
        if ($announcement->count() === 1) {
            Announcement::create([
                'announcement_title' => $media->media_title,
                'announcement_category_id' => $announcement->first()->id,
                'announcement_poster' => $media->media_poster,
                'announcement_link' => route('media.show', $media->media_seo_url),
            ]);
        }
    }

    /**
     * Handle the hobby "creating" event.
     *
     * @param Media $media
     * @return void
     */
    public function creating(Media $media)
    {
        $media->media_edit_by = auth()->id();
    }
}
