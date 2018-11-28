<?php

namespace App\Http\Controllers;

use Auth;
use Gate;
use App\Column;
use App\Columnist;
use Illuminate\Http\Request;

class ColumnController extends Controller
{
    /**
     * Column Page
     */
    public function show(Request $request, $id)
    {
        $column = Column::findOrFail($id);
        $columnist = $column->author;

        $column->increment('read_num');
        $columnist->increment('read_num');

        return view('column.show', compact('column', 'columnist'));
    }

    /**
     * Create Column Page
     */
    public function create($domain)
    {
        $columnist = Columnist::where('domain', $domain)->firstOrFail();

        // gate
        if (!Gate::allows('auth.ownOrAdmin', $columnist)) {
            return back();
        }

        return view('column.create', compact('columnist'));
    }

    /**
     * Stoer Column
     */
    public function store(Request $request, $domain)
    {
        $this->validate($request, [
            'title'         =>  'required|string',
            'content'       =>  'required|string',
        ]);

        $columnist = Columnist::where('domain', $domain)->firstOrFail();

        // gate
        if (!Gate::allows('auth.ownOrAdmin', $columnist)) {
            return back();
        }

        $column = Column::create([
            'user_id'           =>  $columnist->user_id,
            'columnist_id'      =>  $columnist->id,
            'title'             =>  $request->title,
            'content'           =>  $request->content,
        ]);

        if ($column) {
            $columnist->article_num = $columnist->columns()->count();
            $columnist->save();

            flash('发布成功')->success();
            return redirect()->route('column.show', $column->id);
        } else {
            flash('发布失败')->error();
            return back()->withInput();
        }
    }

    /**
     * Edit Column Page
     */
    public function edit($id)
    {
        $column = Column::findOrFail($id);
        $columnist = $column->author;

        // gate
        if (!Gate::allows('auth.ownOrAdmin', $column)) {
            return back();
        }

        return view('column.edit', compact('column', 'columnist'));
    }

    /**
     * Update Column
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title'         =>  'required|string',
            'content'       =>  'required|string',
        ]);

        $column = Column::findOrFail($id);

        // gate
        if (!Gate::allows('auth.ownOrAdmin', $column)) {
            return back();
        }

        $column->title = $request->title;
        $column->content = $request->content;


        if ($column->save()) {
            $column->author->article_num = $column->author->columns()->count();
            $column->author->save();

            flash('更新成功')->success();
            return redirect()->route('column.show', $column->id);
        } else {
            flash('更新失败')->error();
            return back()->withInput();
        }
    }

    /**
     * Destroy Column
     */
    public function destroy($id)
    {
        $column = Column::findOrFail($id);

        // gate
        if (!Gate::allows('auth.ownOrAdmin', $column)) {
            return back();
        }

        if ($column->delete()) {
            $column->author->article_num = $column->author->columns()->count();
            $column->author->save();

            flash('删除成功')->success();
            return redirect()->route('columnist.show', $column->author->domain);
        } else {
            flash('删除失败')->error();
            return back();
        }
    }
}
