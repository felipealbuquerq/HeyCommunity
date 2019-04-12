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
        if ($request->has('q')) {
            $activities = Activity::where('title', 'like', '%' . $request->q . '%')->paginate();
        } else {
            $activities = Activity::latest()->paginate();
        }

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
}
