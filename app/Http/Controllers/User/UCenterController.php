<?php

namespace App\Http\Controllers\User;

use App\Activity;
use App\Topic;
use App\TopicComment;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UCenterController extends Controller
{
    /**
     * Index Page
     */
    public function index()
    {
        $user = Auth::user();
        return view('user.ucenter.index', compact('user'));
    }
}
