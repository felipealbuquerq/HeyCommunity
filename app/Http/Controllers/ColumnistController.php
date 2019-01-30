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
    public function index(Request $request)
    {
        $query = Column::query();

        if ($request->filter) {
            switch ($request->filter) {
                case 'recent':
                    $query->latest();
                    break;
                case 'hot':
                    $query->orderByDesc('comment_num', 'read_num', 'updated_at');
                    break;
                case 'recommend':
                    // @todo
                    $query->latest();
                    break;
                default:
                    $query->latest();
                    break;
            }
        }

        $columns = $query->paginate(10);
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
