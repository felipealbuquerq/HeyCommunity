<?php

namespace App;

class News extends BaseModel
{
    /**
     * Relate DailyPaper
     */
    public function dailyPapers()
    {
        return $this->morphMany(DailyPaper::class, 'entity');
    }

    /**
     * Relate Comment
     */
    public function comments()
    {
        return $this->morphMany('App\Models\Comment', 'belong_entity')->whereNull('parent_id')->latest();
    }

    /**
     * Get In DailyPaper
     */
    public function getInDailyPaperAttribute()
    {
        return $this->dailyPapers()->createdAtInToday()->exists();
    }
}
