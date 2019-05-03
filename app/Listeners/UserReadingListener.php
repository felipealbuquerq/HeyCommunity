<?php

namespace App\Listeners;

use App\Events\UserReadingEvent;
use App\Models\Read;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class UserReadingListener
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
     * @param  UserReadingEvent  $event
     * @return void
     */
    public function handle(UserReadingEvent $event)
    {
        $entity = $event->entity;

        $data = [
            'user_session_id'   =>  session()->getId(),
            'entity_type'       =>  get_class($entity),
            'entity_id'         =>  $entity->id,
        ];
        if (Auth::check()) $data['user_id'] = Auth::id();
        Read::create($data);

        // increment read_num
        if (Schema::hasColumn($entity->getTable(), 'read_num')) {
            $where = array_only($data, ['entity_type', 'entity_id']);

            if (Read::where($where)->where(function ($query) {
                $query->where('user_session_id', session()->getId());

                if (Auth::check()) {
                    $query->orWhere('user_id', Auth::id());
                }
            })->count() <= 1) {
                $entity->increment('read_num');
            }
        }
    }
}
