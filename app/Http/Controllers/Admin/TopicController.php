<?php

namespace App\Http\Controllers\Admin;

use App\Topic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TopicController extends Controller
{
    /**
     * Topic list and search
     */
    public function index(Request $request)
    {
        if ($request->has('q')) {
            $topics = Topic::where('title', 'like', '%'. $request->q . '%')->paginate();
        } else {
            $topics = Topic::latest()->paginate();
        }

        return view('admin.topic.index', compact('topics'));
    }

    /**
     * Topic destroy
     */
    public function destroy(Request $request)
    {
        $this->validate($request, [
            'id'        =>      'required|integer',
        ]);

        Topic::destroy($request->id);
        flash('操作成功');

        return back();
    }
}
