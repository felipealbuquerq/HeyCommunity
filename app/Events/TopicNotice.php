<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class TopicNotice
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $entityName;

    public $entity;

    public $user;

    public $sender;

    public $userId;

    public $senderId;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($entityName, $entity, $user = null, $sender = null)
    {
        $this->entityName = $entityName;
        $this->entity = $entity;
        $this->user = $user;
        $this->sender = $sender;

        $this->userId = $user->id;
        $this->senderId = $sender->id;
    }
}
