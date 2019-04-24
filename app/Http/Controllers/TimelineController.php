<?php

namespace App\Http\Controllers;

use App\Timeline;
use App\TimelineImage;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TimelineController extends Controller
{
    /**
     * Construct
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * Timeline Index Page
     */
    public function index()
    {
        $timelines = Timeline::latest()->paginate();

        $timelineUsers = User::whereIn('id', Timeline::pluck('user_id')->toArray())
                                    ->inRandomOrder()->limit(5)->get();
        return view('timeline.index', compact('timelines', 'timelineUsers'));
    }

    /**
     *
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'content'       =>  'required|string|min:3',
            'imageIds'      =>  'nullable|array',
            'imageIds.*'    =>  'integer',
        ]);

        $timeline = Timeline::create([
            'user_id'       =>  Auth::id(),
            'content'       =>  $request->content,
        ]);

        if ($request->imageIds && is_array($request->imageIds)) {
            TimelineImage::whereIn('id', $request->imageIds)->update([
                'timeline_id'   =>  $timeline->id
            ]);
        }

        // record user activity log
        event(new \App\Events\UserActiveRecordEvent(Auth::user(), $timeline));

        return redirect()->route('timeline.index');
    }

    /**
     *
     */
    public function uploadImage(Request $request)
    {
        $this->validate($request, [
            'image'     =>  'required|image',
        ]);

        $filePath = Storage::putFile('uploads/timlines', $request->image);

        $timelineImage = TimelineImage::create([
            'user_id'       =>  Auth::id(),
            'file_path'     =>  $filePath,
            'image_width'   =>  getimagesize($request->image)[0],
            'image_height'  =>  getimagesize($request->image)[1],
        ]);

        return response()->json($timelineImage);
    }
}
