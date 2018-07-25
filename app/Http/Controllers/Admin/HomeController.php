<?php

namespace App\Http\Controllers\Admin;

use App\Activity;
use App\News;
use App\Topic;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Home Page
     */
    public function index()
    {
        $dateStartOf7Day = Carbon::today()->subDays(7);
        $dateStartOf30Day = Carbon::today()->subDays(30);

        // 用户
        $data['userTotal'] = User::count();
        $data['userTotalOfRecent7Day'] = User::whereDate('created_at', '>', $dateStartOf7Day)->count();
        $data['userTotalOfRecent30Day'] = User::whereDate('created_at', '>', $dateStartOf30Day)->count();
        $data['userTotalOfRecent7DayBefore'] = User::whereDate('created_at', '<', $dateStartOf7Day)->count();
        $data['userGrowthOfRecent7DayPercent'] = $this->makePercent($data['userTotalOfRecent7Day'], $data['userTotalOfRecent7DayBefore'], 2);

        // 用户趋势数据
        $data['userTrendData'] = [];
        for ($i = 0; $i < 7; $i++) {
            $day = Carbon::today()->subDays($i);
            $dayOfEnd = Carbon::today()->subDays($i)->endOfDay();
            $dayOfBefore7 = Carbon::today()->subDays($i)->subDays(7);
            $dayOfBefore7End = Carbon::today()->subDays($i)->subDays(7)->endOfDay();

            $data['userTrendData'][$i]['y'] = $day->format('md');
            $data['userTrendData'][$i]['a'] = User::whereBetween('created_at', [$day, $dayOfEnd])->count();
            $data['userTrendData'][$i]['b'] = User::whereBetween('created_at', [$dayOfBefore7, $dayOfBefore7End])->count();
        }
        $data['userTrendData'] = json_encode($data['userTrendData']);


        // 新闻
        $data['newsTotal'] = News::count();
        $data['newsTotalOfRecent7Day'] = News::whereDate('created_at', '>', $dateStartOf7Day)->count();
        $data['newsTotalOfRecent7DayBefore'] = News::whereDate('created_at', '<', $dateStartOf7Day)->count();
        $data['newsGrowthOfRecent7DayPercent'] = $this->makePercent($data['newsTotalOfRecent7Day'], $data['newsTotalOfRecent7DayBefore'], 2);

        // 话题
        $data['topicTotal'] = Topic::count();
        $data['topicTotalOfRecent7Day'] = Topic::whereDate('created_at', '>', $dateStartOf7Day)->count();
        $data['topicTotalOfRecent7DayBefore'] = Topic::whereDate('created_at', '<', $dateStartOf7Day)->count();
        $data['topicGrowthOfRecent7DayPercent'] = $this->makePercent($data['topicTotalOfRecent7Day'], $data['topicTotalOfRecent7DayBefore'], 2);

        // 活动
        $data['activityTotal'] = Activity::count();
        $data['activityTotalOfRecent7Day'] = Activity::whereDate('created_at', '>', $dateStartOf7Day)->count();
        $data['activityTotalOfRecent7DayBefore'] = Activity::whereDate('created_at', '<', $dateStartOf7Day)->count();
        $data['activityGrowthOfRecent7DayPercent'] = $this->makePercent($data['activityTotalOfRecent7Day'], $data['activityTotalOfRecent7DayBefore'], 2);

        return view('admin.home.index', $data);
    }

    /**
     * 计算百分比
     */
    protected function makePercent($leftVal, $rightVal, $precision = 0)
    {
        if ($rightVal) {
            return round(($leftVal / $rightVal), $precision);
        }

        return 0;
    }
}
