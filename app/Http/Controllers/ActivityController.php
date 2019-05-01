<?php

namespace App\Http\Controllers;

use App\ActivityArea;
use App\ActivityCategory;
use App\Http\Requests\ActivityRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Activity;
use Auth;

class ActivityController extends Controller
{
    /**
     * Activity List Page
     */
    public function index(Request $request)
    {
        $this->validate($request, [
            'category_id'       =>  'integer',
            'area_id'           =>  'integer',
        ]);

        $categories = ActivityCategory::sortOrder()->get();
        $areas = ActivityArea::sortOrder()->get();

        $exhibits = Activity::where('is_exhibited', true)
            ->latest()->limit(5)->get();

        $activitiesQuery = Activity::orderBy('pinned_at', 'desc')->latest();
        if ($request->category_id) $activitiesQuery->where('category_id', $request->category_id);
        if ($request->area_id) $activitiesQuery->where('area_id', $request->area_id);
        $activities = $activitiesQuery->paginate(12);

        return view('activity.index', compact('activities', 'exhibits', 'categories', 'areas'));
    }

    /**
     * Show A Activity
     */
    public function show($id)
    {
        $activity = Activity::findOrFail($id);

        return view('activity.show', compact('activity'));
    }

    /**
     * Create Activity Page
     */
    public function create()
    {
        return view('activity.create');
    }

    /**
     * Store Activity
     */
    public function store(ActivityRequest $request)
    {
        $avatarUrl  = $request->file('avatar')->store('uploads/activity/avatar');

        if ($avatarUrl) {
            $activity = new Activity();
            $activity->user_id = Auth::id();
            $activity->avatar = $avatarUrl;
            $activity->fill($request->only(['title', 'intro', 'content', 'category_id', 'area_id', 'start_time', 'end_time', 'local', 'redirect_url']));
            $activity->start_time = Carbon::parse($request->start_time);
            $activity->end_time = Carbon::parse($request->end_time);

            if ($activity->save()) {
                return redirect()->route('activity.show', $activity->id);
            }
        }

        flash('发布活动失败')->error();
        return back()->withInput();
    }

    /**
     * Edit Activity Page
     */
    public function edit($id)
    {
        $activity = Activity::findOrFail($id);

        return view('activity.edit', compact('activity'));
    }

    /**
     * Update Activity
     */
    public function update(ActivityRequest $request, $id)
    {
        $activity = Activity::findOrFail($id);

        $activity->fill($request->only(['title', 'intro', 'content', 'category_id', 'area_id', 'start_time', 'end_time', 'local', 'redirect_url']));
        $activity->start_time = Carbon::parse($request->start_time);
        $activity->end_time = Carbon::parse($request->end_time);

        if ($request->avatar) {
            $avatarUrl  = $request->file('avatar')->store('uploads/activity/avatar');
            $activity->avatar = $avatarUrl;
        }

        if ($activity->save()) {
            return redirect()->route('activity.show', $activity->id);
        } else {
            flash('发布活动失败')->error();
            return back()->withInput();
        }
    }
}
