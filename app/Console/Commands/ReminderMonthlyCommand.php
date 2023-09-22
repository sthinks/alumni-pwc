<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Notifications\ReminderMonthly;
use App\User;
use App\Announcement;
use Carbon\Carbon;
use Illuminate\Support\Facades\Notification;

class ReminderMonthlyCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cron:reminder:monthly';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Sends monthly for the users who didn't log in for a month";

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
     * @return int
     */
    public function handle()
    {
        // get users who didn't log in for 30 days
        $users = DB::table('authentication_log')
        ->selectRaw('authenticatable_id, MAX(login_at) AS last_login')
        ->groupBy('authenticatable_id')
        ->havingRaw('DATE(last_login) < DATE_SUB(CURDATE(), INTERVAL 30 DAY)')
        ->pluck('authenticatable_id');

        // find already notified users
        $notifiedUsers = DB::table("notifications")
            ->where('created_at', '>', now()->subDays(30)->endOfDay())
            ->where('type', ReminderMonthly::class)
            ->pluck("notifiable_id");

        // get last 30 day posts
        $date = Carbon::now()->subDays(30);
        $announcements = Announcement::where('created_at', '>=', $date)->latest()->take(5)->get();


        $usersToNotify = User::whereIn('id', $users->diff($notifiedUsers))->get();
        if($announcements->count() > 0) {
            Notification::send($usersToNotify, new ReminderMonthly($announcements));
        }

        $this->info(sprintf('%d user notified', $usersToNotify->count()));
    }
}
