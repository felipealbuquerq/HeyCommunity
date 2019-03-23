<?php

namespace App\Http\Controllers;

use App\Timeline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TimelineController extends Controller
{
    /**
     * Timeline Index Page
     */
    public function index()
    {
        $timelines = Timeline::latest()->paginate();

        return view('timeline.index', compact('timelines'));
    }

    /**
     *
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'content'       =>  'required|string|min:3',
        ]);

        Timeline::create([
            'user_id'       =>  Auth::id(),
            'content'       =>  $request->content,
        ]);

        return redirect()->route('timeline.index');
    }
}
