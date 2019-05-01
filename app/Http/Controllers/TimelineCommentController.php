<?php

namespace App\Http\Controllers;

use App\TimelineComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TimelineCommentController extends Controller
{
    /**
     * Construct
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'timeline_id'       =>  'required|integer',
            'comment_id'        =>  'nullable|integer',
            'content'           =>  'required|string',
        ]);

        $data = $request->only(['timeline_id', 'comment_id', 'content']);
        $data['user_id'] = Auth::id();

        $comment = TimelineComment::create($data);

        // record user activity log
        event(new \App\Events\UserActiveRecordEvent(Auth::user(), $comment));

        flash('评论成功')->success();
        return back();
    }
}
