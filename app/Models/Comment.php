<?php

namespace App\Models;

use App\BaseModel;

class Comment extends BaseModel
{
    /**
     * Relation Entity
     */
    public function belongEntity()
    {
        return $this->morphTo('belong_entity', 'belong_entity_type', 'belong_entity_id');
    }

    /**
     * Related SubComment
     */
    public function comments()
    {
        return $this->HasMany('App\Models\Comment', 'parent_id', 'id')->latest();
    }

    /**
     * Related Parent Comment
     */
    public function parent()
    {
        return $this->belongsTo('App\Models\Comment', 'parent_id', 'id');
    }
}
