<?php

namespace App;

class TimelineComment extends BaseModel
{
    /**
     * Related Timeline
     */
    public function timeline()
    {
        return $this->belongsTo('App\Timeline');
    }
}
