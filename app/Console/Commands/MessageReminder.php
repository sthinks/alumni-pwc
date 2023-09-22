<?php

namespace App\Console\Commands;

use App\Notifications\MessageReminderNotification;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class MessageReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cron:reminder:message {days=7}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Remind user check their message if they haven't replied a message older than 7 days";

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
        // read day limit from input
        $dayLimit = (int) $this->argument('days');

        // find users who didn't check their messenger
        $threshold = Carbon::now()->subDays($dayLimit);

        $unreads = DB::select('SELECT `to`, MAX(n.created_at) as last_notification_created_at, MAX(messages.created_at) as last_message_created_at FROM messages
LEFT JOIN (SELECT * FROM notifications
           WHERE type = ?) as n ON messages.to = n.notifiable_id
WHERE `read` = 0
GROUP BY `to`', [MessageReminderNotification::class]);
        foreach ($unreads as $unread) {
            // get the user
            $user = User::alumni()->find($unread->to);
            // if not, notify user again
            if (($unread->last_notification_created_at === null && $unread->last_message_created_at < $threshold) || ($unread->last_notification_created_at !== null && $unread->last_message_created_at > $unread->last_notification_created_at)) {
                $user->notify(new MessageReminderNotification());
                $this->info("{$user->getFirstName()} informed");
            }
        }
    }
}
