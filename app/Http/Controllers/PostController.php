<?php

namespace App\Http\Controllers;

use App\Events\UserReadingEvent;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    /**
     * Post Index Page
     */
    public function index()
    {
        $posts = Post::latest()->paginate(12);

        return view('post.index', compact('posts'));
    }

    /**
     * Show A Post
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);

        // user reading
        event(new UserReadingEvent($post));

        $view = 'post.show';

        if ($post->type_id == 2) {
            $view = 'post.iframe-show';

            if (substr($post->origin_url, 0, 5) == 'http:') {
                return redirect()->to($post->origin_url);
            }
        }

        return view($view, compact('post'));
    }

    /**
     * Create Post Page
     */
    public function create()
    {
        $post = new Post();

        $subNavName = '发布资讯';
        $formActionUrl = route('post.store');

        return view('post.form', compact('post', 'subNavName', 'formActionUrl'));
    }

    /**
     * Store Post
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title'         =>      'required|string',
            'type_id'       =>      [
                'required',
                Rule::in(array_keys(Post::$typeIds)),
            ],
            'origin_url'    =>      'nullable|url',
            'content'       =>      'nullable|string|min:3',
        ]);

        $post = new Post();
        $post->title = $request->title;
        $post->type_id = $request->type_id;
        $post->origin_url = $request->origin_url;
        $post->content = clean($request->get('content'));

        if ($post->save()) {
            return redirect()->route('post.show', $post->id);
        } else {
            return back()->withInput();
        }
    }

    /**
     * Edit Post Page
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);

        $subNavName = '更新资讯';
        $formActionUrl = route('post.update', $post->id);

        return view('post.form', compact('post', 'subNavName', 'formActionUrl'));
    }

    /**
     * Post Update Handle
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title'         =>      'required|string',
            'type_id'       =>      [
                'required',
                Rule::in(array_keys(Post::$typeIds)),
            ],
            'origin_url'    =>      'nullable|url',
            'content'       =>      'nullable|string|min:3',
        ]);

        $post = Post::findOrFail($id);

        if ($post->update($request->only(['title', 'content', 'type_id', 'origin_url']))) {
            return redirect()->route('post.show', $post->id);
        } else {
            return back()->withInput();
        }
    }
}
