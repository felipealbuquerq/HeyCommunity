<?php

namespace App\Http\Controllers;

use App\Column;
use App\Columnist;
use App\Events\UserReadingEvent;
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

        // user reading
        event(new UserReadingEvent($columnist));

        $query = $columnist->columns();

        if ($request->filter) {
            switch ($request->filter) {
                case 'recent':
                    $query->latest();
                    break;
                case 'hot':
                    $query->orderByDesc('comment_num', 'favorite_num', 'thumb_up_num', 'read_num', 'updated_at')
                    ->latest();
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

        $columns = $query->paginate(6);

        return view('columnist.show', compact('columnist', 'columns'));
    }
}
