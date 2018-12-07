<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Post Index Page
     */
    public function index()
    {
        $posts = Post::latest()->paginate(10);

        return view('post.index', compact('posts'));
    }

    /**
     * Show A Post
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);

        return view('post.show', compact('post'));
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
            'content'       =>      'required|string|min:10',
        ]);

        $post = new Post();
        $post->title = $request->title;
        $post->content = clean($request->content);

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
            'content'       =>      'required|string|min:10',
        ]);

        $post = Post::findOrFail($id);

        if ($post->update($request->only(['title', 'content']))) {
            return redirect()->route('post.show', $post->id);
        } else {
            return back()->withInput();
        }
    }
}
