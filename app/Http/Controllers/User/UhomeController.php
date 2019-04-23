<?php

namespace App\Http\Controllers\User;

use App\Activity;
use App\Topic;
use App\TopicComment;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UhomeController extends Controller
{
    /**
     * Index Page
     */
    public function index($id)
    {
        return redirect()->route('user.uhome.topic-published', $id);
    }

    /**
     * Topic Published Page
     */
    public function topicPublished($id)
    {
        $user = User::findOrFail($id);
        $topics = Topic::where(['user_id' => $user->id])->paginate(10);

        return view('user.uhome.topic-published', compact('user', 'topics'));
    }

    /**
     * Topic Replies Page
     */
    public function topicReplies($id)
    {
        $user = User::findOrFail($id);
        $topicComments = TopicComment::where('user_id', $user->id)->latest()->paginate(10);

        return view('user.uhome.topic-replies', compact('user', 'topicComments'));
    }

    /**
     * Activity Page
     */
    public function activity($id)
    {
        $user = User::findOrFail($id);
        $activities = Activity::where(['user_id' => $user->id])->paginate(12);

        return view('user.uhome.activity', compact('user', 'activities'));
    }
}
