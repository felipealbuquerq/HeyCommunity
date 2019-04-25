<?php

namespace App\Models\User;

use App\BaseModel;

class UserActiveRecord extends BaseModel
{
    /**
     * Related Entity
     */
    public function entity()
    {
        return $this->morphTo('entity', 'entity_type', 'entity_id');
    }

    /**
     * Get Entity Blade Tpl
     */
    public function getEntityBladeTplAttribute()
    {
        return '_' . str_replace('\\', '', snake_case($this->entity_type));
    }
}
