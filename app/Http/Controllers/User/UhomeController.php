<?php

namespace App\Http\Controllers\User;

use App\Activity;
use App\Events\UserReadingEvent;
use App\Models\User\UserActiveRecord;
use App\Timeline;
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
        $user = User::findOrFail($id);
        $records = UserActiveRecord::where('user_id', $user->id)->latest()->paginate(10);

        // user reading
        event(new UserReadingEvent($user));

        return view('user.uhome.index', compact('user', 'records'));
    }

    /**
     * Timeline Page
     */
    public function timeline($id)
    {
        $user = User::findOrFail($id);
        $timelines = Timeline::where('user_id', $id)->latest()->paginate(5);

        return view('user.uhome.timeline', compact('user', 'timelines'));
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
