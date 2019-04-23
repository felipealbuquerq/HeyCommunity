<?php

namespace App\Http\Controllers\User;

use App\Activity;
use App\Topic;
use App\TopicComment;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UCenterController extends Controller
{
    /**
     * Index Page
     */
    public function index()
    {
        return redirect()->route('user.ucenter.topic-published');
    }

    /**
     * Topic Published Page
     */
    public function topicPublished()
    {
        $user = Auth::user();
        $topics = Topic::where(['user_id' => $user->id])->paginate(10);

        return view('user.ucenter.topic-published', compact('user', 'topics'));
    }

    /**
     * Topic Replies Page
     */
    public function topicReplies()
    {
        $user = Auth::user();
        $topicComments = TopicComment::where('user_id', $user->id)->latest()->paginate(10);

        return view('user.ucenter.topic-replies', compact('user', 'topicComments'));
    }

    /**
     * Activity Page
     */
    public function activity()
    {
        $user = Auth::user();
        $activities = Activity::where(['user_id' => $user->id])->paginate(12);

        return view('user.ucenter.activity', compact('user', 'activities'));
    }
}
