<?php

namespace App;

class Column extends BaseModel
{
    /**
     * Related Columnist
     */
    public function author()
    {
        return $this->belongsTo('App\Columnist', 'columnist_id', 'id');
    }

    /**
     * Relate Comment
     */
    public function comments()
    {
        return $this->morphMany('App\Models\Comment', 'entity')
            ->whereNull('parent_id')->latest();
    }
}
