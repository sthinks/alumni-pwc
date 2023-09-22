<?php

namespace App\Observers;

use App\Announcement;
use App\AnnouncementCategory;
use App\Campaign;

class CampaignObserver
{
    /**
     * Handle the campaign "creating" event.
     *
     * @param Campaign $campaign
     * @return void
     */
    public function creating(Campaign $campaign)
    {
        $campaign->campaign_edit_by = auth()->id();
    }

    /**
     * Handle the campaign "created" event.
     *
     * @param Campaign $campaign
     * @return void
     */
    public function created(Campaign $campaign)
    {
        // push an announcement
        $announcement = AnnouncementCategory::where('id', 2)->get();
        if ($announcement->count() === 1) {
            Announcement::create([
                'announcement_title' => $campaign->campaign_title,
                'announcement_category_id' => $announcement->first()->id,
                'announcement_poster' => $campaign->campaign_poster,
                'announcement_link' => route('campaign.show', $campaign->campaign_seo_url),
            ]);
        }
    }
}
