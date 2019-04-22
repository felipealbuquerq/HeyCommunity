<?php

namespace App;

use App\Models\Comment;

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
        return $this->morphMany(Comment::class, 'belong_entity')->latest();
    }

    /**
     * Get In DailyPaper
     */
    public function getInDailyPaperAttribute()
    {
        return $this->dailyPapers()->createdAtInToday()->exists();
    }
}
