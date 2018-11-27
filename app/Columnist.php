<?php

namespace App;

class Columnist extends BaseModel
{
    /**
     * Related Columns
     */
    public function columns()
    {
        return $this->hasMany('App\Column', 'columnist_id', 'id')->latest();
    }
}
