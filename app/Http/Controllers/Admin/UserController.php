<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * User list and search
     */
    public function index(Request $request)
    {
        $query = User::latest();

        if ($request->has('q')) {
            $query->where('nickname', 'like', '%' . $request->q . '%');
            if (intval($request->q)) {
                $query->orWhere('id', $request->q);
            }
        }

        $users = $query->paginate();

        return view('admin.user.index', compact('users'));
    }
}
