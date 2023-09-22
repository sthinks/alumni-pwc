<?php

namespace App\Jobs;

use App\Announcement;
use App\Notifications\AnnouncementCreated;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;

class NewAnnouncementUserNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    private User $users;

    /**
     * @var Announcement the announcement which will be pushed to users
     */
    private Announcement $announcement;

    public function __construct($users, $announcement)
    {
        $this->users = $users;
        $this->announcement = $announcement;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Notification::send(
            $this->users,
            new AnnouncementCreated($this->announcement)
        );
    }
}
