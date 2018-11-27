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
}
