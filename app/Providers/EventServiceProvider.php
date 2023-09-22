<?php

namespace App\Providers;

use App\Announcement;
use App\Campaign;
use App\Event;
use App\Events\NewJobShared;
use App\Events\ProfileUpdated;
use App\Events\UserApproved;
use App\Events\UserJoinedHobbyClub;
use App\Events\UserRejected;
use App\Hobby;
use App\JobOffer;
use App\Knowledge;
use App\Listeners\NewUserRegistered;
use App\Listeners\NotifyUserJoinedHobbyClub;
use App\Listeners\SendCrmUpdate;
use App\Listeners\SendNewJobSharedNotification;
use App\Listeners\UserApprovedListener;
use App\Listeners\UserRejectedListener;
use App\Media;
use App\Observers\AnnouncementObserver;
use App\Observers\CampaignObserver;
use App\Observers\EventObserver;
use App\Observers\HobbyObserver;
use App\Observers\JobOfferObserver;
use App\Observers\KnowledgeObserver;
use App\Observers\MediaObserver;
use App\Observers\SliderObserver;
use App\Observers\UserObserver;
use App\Slider;
use App\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            NewUserRegistered::class,
        ],
        'Illuminate\Auth\Events\Failed' => [
            'App\Listeners\LogFailedLogin',
        ],
        'Illuminate\Auth\Events\Lockout' => [
            'App\Listeners\LogLockout',
        ],
        'Illuminate\Auth\Events\PasswordReset' => [
            'App\Listeners\LogPasswordReset',
        ],
        ProfileUpdated::class => [
            SendCrmUpdate::class,
        ],
        UserApproved::class => [
            UserApprovedListener::class,
        ],
        UserRejected::class => [
            UserRejectedListener::class,
        ],
        NewJobShared::class => [
            SendNewJobSharedNotification::class,
        ],
        UserJoinedHobbyClub::class => [
            NotifyUserJoinedHobbyClub::class
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Announcement::observe(AnnouncementObserver::class);
        Campaign::observe(CampaignObserver::class);
        JobOffer::observe(JobOfferObserver::class);
        Event::observe(EventObserver::class);
        Hobby::observe(HobbyObserver::class);
        Knowledge::observe(KnowledgeObserver::class);
        Slider::observe(SliderObserver::class);
        User::observe(UserObserver::class);
        Media::observe(MediaObserver::class);
    }
}
