<?php

namespace App\Http\Controllers;

use App\Column;
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
}
