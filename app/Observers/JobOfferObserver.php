<?php

namespace App\Observers;

use App\Announcement;
use App\AnnouncementCategory;
use App\JobOffer;

class JobOfferObserver
{
    /**
     * Handle the job offer "creating" event.
     *
     * @param JobOffer $jobOffer
     * @return void
     */
    public function creating(JobOffer $jobOffer)
    {
        $jobOffer->job_edit_by = auth()->id();
    }

    /**
     * Handle the campaign "created" event.
     *
     * @param JobOffer $jobOffer
     * @return void
     */
    public function created(JobOffer $jobOffer)
    {
        // push an announcement
        $announcement = AnnouncementCategory::where('id', 3)->get();
        if ($announcement->count() === 1) {
            Announcement::create([
                'announcement_title' => $jobOffer->job_title,
                'announcement_category_id' => $announcement->first()->id,
                'announcement_poster' => 'is_ilani.jpg',
                'announcement_link' => route('jobs.show', $jobOffer->job_seo_url),
            ]);
        }
    }
}
