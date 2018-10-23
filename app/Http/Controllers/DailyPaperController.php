<?php

namespace App\Http\Controllers;

use App\DailyPaper;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DailyPaperController extends Controller
{
    /**
     * Index Page
     */
    public function index(Request $request)
    {
        $this->validate($request, [
            'day'       =>      'date',
        ]);

        $query = DailyPaper::latest();

        if ($request->day) {
            $query->whereDate('created_at', '>=', Carbon::parse($request->day)->startOfDay());
            $query->whereDate('created_at', '<=', Carbon::parse($request->day)->endOfDay());
        } else {
            $query->whereDate('created_at', '>=', Carbon::today()->startOfDay());
            $query->whereDate('created_at', '<=', Carbon::today()->endOfDay());
        }

        $dailies = $query->get();

        return view('daily-paper.index', compact('dailies'));
    }
}
