<?php

namespace App\Providers;

use App\Chat\Chatapp;
use App\Facades\ChatFacade;
use App\HttpLogger\Contracts\LogProfile;
use App\HttpLogger\Contracts\LogWriter;
use App\HttpLogger\DefaultLogWriter;
use App\HttpLogger\LogNonGetRequests;
use App\Services\Contracts\SMSServiceContract;
use App\Services\TuratelService;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(SMSServiceContract::class, function ($app) {
            $provider = strtolower(config('services.sms.provider'));
            switch ($provider) {
                default:
                    return new TuratelService();
            }
        });
        $this->app->bind('chat_app', function ($app) {
            return new Chatapp();
        });
        $this->app->singleton(LogProfile::class, LogNonGetRequests::class);
        $this->app->singleton(LogWriter::class, DefaultLogWriter::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // share common variables
        View::composer([
            'alumni.layout.header',
            'alumni.layout.homeheader',
        ], function ($view) {
            if (auth()->check()) {
                $user = auth()->user();
                // notifications
                $notifications = $user->notifications()->get();
                $notifications->map(function ($notification) {
                    $notification->is_read = isset($notification->read_at);
                    $notification->when = $notification->created_at->diffForHumans();
                    $notification->message = $notification->data['message'];
                    $notification->link = $notification->id;
                    return $notification;
                });

                // unread notification
                $unread_notifications = $user->unreadNotifications()->count();

                // number of unread messages
                $unread_messages = ChatFacade::countUnseenMessages();
                $view->with([
                    'shared_alumni_user' => $user,
                    'notifications' => $notifications,
                    'number_of_notification' => $unread_notifications,
                    'unread_messages' => $unread_messages,
                ]);
            }
        });

        // Api response
        Response::macro('api', function ($statusCode, $data = [], $message = null) {
            $success = $statusCode >= 200 && $statusCode < 300;
            return Response::json(
                [
                    'statusCode' => $statusCode,
                    'success' => $success,
                    'messages' => $message,
                    'data' => $data,
                ],
                $statusCode
            );
        });
    }
}
