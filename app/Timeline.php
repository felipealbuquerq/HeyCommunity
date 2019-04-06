<?php

namespace App;

class Timeline extends BaseModel
{
    /**
     * Relate Timeline Image
     */
    public function images()
    {
        return $this->hasMany(TimelineImage::class);
    }

    /**
     * Relate Timeline Comment
     */
    public function comments()
    {
        return $this->hasMany(TimelineComment::class)->latest();
    }
}
