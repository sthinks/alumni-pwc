<?php

namespace App\Observers;

use App\Events\ProfileUpdated;
use App\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserDeletedAccount;


class UserObserver
{

    /**
     * Handle the user "updating" event.
     *
     * @param User $user
     * @return void
     */
    public function updating(User $user)
    {
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }
        if ($user->isDirty('second_mail')) {
            $user->second_mail_verified_at = null;
        }
    }

    /**
     * Handle the user "updated" event.
     *
     * @param User $user
     * @return void
     */
    public function updated(User $user)
    {
        // update user crm
        event(new ProfileUpdated($user));
    }

    /**
     * Handle the user "saved" event.
     *
     * @param User $user
     * @return void
     */
    public function saved(User $user)
    {
        // update user in crm
        event(new ProfileUpdated($user));        
    }


    /**
     * Handle the user "created" event.
     *
     * @param User $user
     * @return void
     */
    public function created(User $user)
    {
        $user->passwordHistory()->create(['password' => $user->password]);
    }

    /**
     * Handle the user "creating" event.
     *
     * @param User $user
     * @return void
     */
    public function creating(User $user)
    {
        $user->clarification_text = now();
        $user->user_agreement = now();
        $user->uid = Str::uuid();
    }
    /**
     * Handle the User "deleted" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        Mail::send(new UserDeletedAccount($user));
    }
}
