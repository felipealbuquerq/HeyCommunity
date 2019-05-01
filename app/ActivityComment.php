<?php

namespace App;

class ActivityComment extends BaseModel
{
    /**
     * Related Comment
     */
    public function comments()
    {
        return $this->HasMany('App\ActivityComment', 'parent_id', 'id')->latest();
    }

}
