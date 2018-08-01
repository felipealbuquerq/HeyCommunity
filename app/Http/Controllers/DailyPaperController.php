<?php

namespace App\Http\Controllers;

use App\DailyPaper;
use Illuminate\Http\Request;

class DailyPaperController extends Controller
{
    /**
     * Index Page
     */
    public function index()
    {
        $dailies = DailyPaper::latest()->get();

        return view('daily-paper.index', compact('dailies'));
    }
}
