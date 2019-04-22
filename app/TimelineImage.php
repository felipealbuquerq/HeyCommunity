<?php

namespace App;

class TimelineImage extends BaseModel
{
    /**
     * File Path Attribute
     */
    public function getFilePathAttribute($value)
    {
        return makeCdnAssetPath($value);
    }
}
