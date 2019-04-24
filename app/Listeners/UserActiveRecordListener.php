<?php

namespace App\Listeners;

use App\Events\UserActiveRecord;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserActiveRecordListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserActiveRecord  $event
     * @return void
     */
    public function handle(UserActiveRecord $event)
    {
        \App\Models\User\UserActiveRecord::create([
            'user_id'       =>  $event->user->id,
            'entity_type'   =>  get_class($event->entity),
            'entity_id'     =>  $event->entity->id,
        ]);
    }
}
