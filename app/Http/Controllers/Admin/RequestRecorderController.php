<?php

namespace App\Http\Controllers\Admin;

use App\Models\System\RequestRecorder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class RequestRecorderController extends Controller
{
    /**
     * Index page
     */
    public function index(Request $request)
    {
        $requestRecorderQuery = RequestRecorder::query();

        // 访客昵称或 ID
        if ($request->get('keyword')) {
            $requestRecorderQuery->whereHas('user', function ($query) use ($request) {
                $keyword = '%' . $request->get('keyword') . '%';
                $query->where('nickname', 'like', $keyword)->orWhere('id', 'like', $keyword);
            });
        }

        // 访客 IP
        if ($request->get('ip')) {
            $requestRecorderQuery->where('ip', 'like', '%' . $request->get('ip') . '%');
        }

        // 访客类型
        if ($request->get('visitor_type') == 'user') {
            $requestRecorderQuery->whereNotNull('user_id');
        } elseif ($request->get('visitor_type') == 'guest') {
            $requestRecorderQuery->whereNull('user_id');
        }

        // 请求类型
        if ($request->get('method') == 'GET' || $request->get('method') == 'POST') {
            $requestRecorderQuery->where('method', $request->get('method'));
        }

        // @todo 时间

        // 过滤后台记录
        $requestRecorderQuery->where('route_name', 'not like', 'admin.%');

        // 过滤管理员记录
        $requestRecorderQuery->whereHas('user', function ($query) {
            $query->where('is_super_admin', 0);
        });

        $recorders = $requestRecorderQuery->latest()->paginate();

        return view('admin.request-recorder.index', compact('recorders'));
    }

    /**
     * Rank Index Page
     */
    public function rankIndex(Request $request)
    {
        $recorders = RequestRecorder::whereNotNull('user_id')
            ->where('route_name', 'not like', 'admin.%')
            ->select('*', DB::raw('count(*) as total'), DB::raw('max(created_at) as created_at'))
            ->groupBy('user_id')
            ->orderBy('created_at', 'desc')
            ->paginate();

        return view('admin.request-recorder.rank-index', compact('recorders'));
    }
}
