<?php

namespace App\Console\Commands;

use App\Notifications\BirthdayMessage;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Notification;

class BirthdayNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cron:birthday';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command sends users birthday mail';

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
        // get users who was born today
        $users = User::alumni()
            ->whereMonth('birthdate', '=', Carbon::now()->format('m'))
            ->whereDay('birthdate', '=', Carbon::now()->format('d'))
            ->get();

        // notify users
        Notification::send($users, new BirthdayMessage());
        $this->info(sprintf('%d user notified', $users->count()));
    }
}
