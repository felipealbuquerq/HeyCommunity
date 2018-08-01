<?php

namespace App;

class DailyPaper extends BaseModel
{
    /**
     * Relation Entity
     */
    public function entity()
    {
        return $this->morphTo('entity', 'entity_type', 'entity_id');
    }
}
