<?php

namespace App;

use Carbon\Carbon;

class DailyPaper extends BaseModel
{
    /**
     * Relation Entity
     */
    public function entity()
    {
        return $this->morphTo('entity', 'entity_type', 'entity_id');
    }

    /**
     * Get Title
     */
    public function getTitleAttribute()
    {
        switch ($this->entity_type) {
            case News::class:
            case Topic::class:
            case Activity::class:
                return $this->entity->title;
            default:
                return '未定义标题';
        }
    }

    /**
     * Get Type Name
     */
    public function getTypeNameAttribute()
    {
        switch ($this->entity_type) {
            case News::class:
                return '新闻';
            case Topic::class:
                return '话题';
            case Activity::class:
                return '活动';
            default:
                return '未定义';
        }
    }

    /**
     * Get Date
     */
    public function getDateAttribute()
    {
        return Carbon::parse($this->created_at)->startOfDay();
    }
}
