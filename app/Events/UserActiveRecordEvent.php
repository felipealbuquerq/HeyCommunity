<?php

namespace App\Events;

use App\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UserActiveRecordEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $entity;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, $entity)
    {
        $this->user = $user;
        $this->entity = $entity;
    }
}
