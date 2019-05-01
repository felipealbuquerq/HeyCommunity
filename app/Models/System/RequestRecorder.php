<?php

namespace App\Models\System;

use App\BaseModel;
use Carbon\Carbon;

class RequestRecorder extends BaseModel
{
    /**
     * Get Recent Total
     */
    public function getRecentTotal($dayNum)
    {
        $startTime = Carbon::today()->startOfDay()->subDays($dayNum - 1);
        $endTime = Carbon::today()->endOfDay();

        return RequestRecorder::where('user_id', $this->user_id)
            ->whereBetween('created_at', [$startTime, $endTime])
            ->count();
    }
}
