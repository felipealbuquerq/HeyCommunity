<?php

namespace App\Http\Controllers;

use App\Column;
use App\Columnist;
use Illuminate\Http\Request;

class ColumnistController extends Controller
{
    /**
     * Columnist Index Page
     */
    public function index()
    {
        $columns = Column::latest()->paginate(10);
        $recentColumnists = Columnist::latest()->limit(10)->get();

        return view('columnist.index', compact('columns', 'recentColumnists'));
    }


    /**
     * Columnist Show Page
     */
    public function show(Request $request, $domain)
    {
        $columnist = Columnist::where('domain', $domain)->firstOrFail();

        return view('columnist.show', compact('columnist'));
    }
}
