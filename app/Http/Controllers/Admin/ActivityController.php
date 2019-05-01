<?php

namespace App\Http\Controllers\Admin;

use App\Activity;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    /**
     * Activities list and search
     */
    public function index(Request $request)
    {
        $activitiesQuery = Activity::query();

        if ($request->has('q')) {
            $activitiesQuery->where('title', 'like', '%' . $request->q . '%');
        }

        $activitiesQuery->orderBy('is_pinned', 'desc');

        $activities = $activitiesQuery->latest()->paginate();

        return view('admin.activity.index', compact('activities'));
    }

    /**
     * Activities delete
     */
    public function destroy(Request $request)
    {
        $this->validate($request, [
            'id'        =>      'required|integer',
        ]);

        Activity::destroy($request->id);
        flash('操作成功');

        return back();
    }

    /**
     * Activities Set Exhibited
     */
    public function setExhibitHandler(Request $request)
    {
        $this->validate($request, [
            'id'                =>      'required|integer',
            'is_exhibited'      =>      'required|boolean',
        ]);

        $activity = Activity::findOrFail($request->id);

        // set exhibited
        if (!$activity->is_exhibited && $request->is_exhibited == true) {
            $activity->is_exhibited = true;
            $activity->exhibited_at = now();
            $activity->save();
        }

        // unset exhibited
        if ($activity->is_exhibited && $request->is_exhibited == false) {
            $activity->is_exhibited = false;
            $activity->exhibited_at = null;
            $activity->save();
        }

        return back();
    }

    /**
     * Activities Set Pinned
     */
    public function setPinHandler(Request $request)
    {
        $this->validate($request, [
            'id'                =>      'required|integer',
            'is_pinned'         =>      'required|boolean',
        ]);

        $activity = Activity::findOrFail($request->id);

        // set pinned
        if (!$activity->is_pinned && $request->is_pinned == true) {
            $activity->is_pinned = true;
            $activity->pinned_at = now();
            $activity->save();
        }

        // unset pinned
        if ($activity->is_pinned && $request->is_pinned == false) {
            $activity->is_pinned = false;
            $activity->pinned_at = null;
            $activity->save();
        }

        return back();
    }
}
