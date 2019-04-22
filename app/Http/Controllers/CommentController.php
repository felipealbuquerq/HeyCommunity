<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'belong_entity_type'        =>  'required|string',
            'belong_entity_id'          =>  'required|integer',
            'content'                   =>  'required|string',
            'parent_id'                 =>  'nullable|integer',
        ]);

        $belongEntity = with(new $request->belong_entity_type())->query()->findOrFail($request->belong_entity_id);

        $data = $request->only(['belong_entity_type', 'belong_entity_id', 'content', 'parent_id']);
        $data['user_id'] = Auth::id();
        $data['floor_number'] = $belongEntity->comments()->withTrashed()->count() + 1;

        $comment = Comment::create($data);

        if ($comment) {
            flash('评论成功')->success();

            return back();
        } else {
            flash('评论失败')->error();

            return back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
