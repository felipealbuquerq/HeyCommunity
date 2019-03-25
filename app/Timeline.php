<?php

namespace App;

class Timeline extends BaseModel
{
    public function images()
    {
        return $this->hasMany(TimelineImage::class);
    }
}
