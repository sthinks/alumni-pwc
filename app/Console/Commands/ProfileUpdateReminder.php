<?php

namespace App\Console\Commands;

use App\Notifications\ProfileUpdateReminderNotification;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class ProfileUpdateReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cron:reminder:update {days=90}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Profile update reminder for those who didn't update their profile lately";

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $users = User::alumni()
            ->where('updated_at', '<', now()->subDays(90)->endOfDay())
            ->pluck("id");

        // notified users for this notification type
        $notifiedUsers = DB::table("notifications")
            ->where('created_at', '>', now()->subDays(30)->endOfDay())
            ->where('type', ProfileUpdateReminderNotification::class)
            ->pluck("notifiable_id");

        $usersToNotify = User::alumni()->whereIn('id', $users->diff($notifiedUsers))->get();

        Notification::send($usersToNotify, new ProfileUpdateReminderNotification());

        $this->info(sprintf('%d user notified', $usersToNotify->count()));
    }
}
