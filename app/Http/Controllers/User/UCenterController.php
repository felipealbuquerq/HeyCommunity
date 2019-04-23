<?php

namespace App\Http\Controllers\User;

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

    /**
     * Profile Page
     */
    public function profile()
    {
        $user = Auth::user();
        return view('user.ucenter.profile', compact('user'));
    }

    /**
     * Profile Page
     */
    public function profileEdit()
    {
        $user = Auth::user();
        return view('user.ucenter.profile-edit', compact('user'));
    }

    /**
     * Profile Page
     */
    public function profileUpdate(Request $request)
    {
        $user = Auth::user();

        $this->validate($request, [
            'nickname'      =>  'required|string|max:10',
            'gender'        =>  'required|integer',
            'phone'         =>  'nullable|string|size:11|unique:users,phone,' . $user->id,
            'email'         =>  'nullable|string|email|unique:users,email,' . $user->id,
            'bio'           =>  'nullable|string|max:100',
        ]);

        $user->nickname = $request->nickname;
        $user->gender = $request->gender;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->bio = $request->bio;

        if ($user->save()) {
            flash('更新成功')->success();
            return redirect()->route('user.ucenter.profile');
        } else {
            flash('更新失败')->error()->important();
            return back()->withInput();
        }
    }

    /**
     * Index Page
     */
    public function realnameVerify()
    {
        $user = Auth::user();
        return view('user.ucenter.index', compact('user'));
    }

    /**
     * Index Page
     */
    public function settingNotice()
    {
        $user = Auth::user();
        return view('user.ucenter.index', compact('user'));
    }

    /**
     * Index Page
     */
    public function SecurityCenter()
    {
        $user = Auth::user();
        return view('user.ucenter.index', compact('user'));
    }

}
