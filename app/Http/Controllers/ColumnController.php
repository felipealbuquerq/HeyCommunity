<?php

namespace App\Http\Controllers;

use Auth;
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

        return view('column.show', compact('column', 'columnist'));
    }

    /**
     * Create Column Page
     */
    public function create($domain)
    {
        $columnist = Columnist::where('domain', $domain)->firstOrFail();

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

        $column = Column::create([
            'user_id'           =>  Auth::id(),
            'columnist_id'      =>  $columnist->id,
            'title'             =>  $request->title,
            'content'           =>  $request->content,
        ]);

        if ($column) {
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

        $column->title = $request->title;
        $column->content = $request->content;


        if ($column->save()) {
            flash('更新成功')->success();
            return redirect()->route('column.show', $column->id);
        } else {
            flash('更新失败')->error();
            return back()->withInput();
        }
    }
}
