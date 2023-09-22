<?php

namespace App\Events;

use App\Hobby;
use App\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserJoinedHobbyClub
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    private Hobby $hobby;
    private User $user;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Hobby $hobby, User $user)
    {
        $this->hobby = $hobby;
        $this->user = $user;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }

    /**
     * @return Hobby
     */
    public function getHobby(): Hobby
    {
        return $this->hobby;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }
}
