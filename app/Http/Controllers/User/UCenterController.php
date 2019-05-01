<?php

namespace App\Http\Controllers\User;

use App\Models\User\UserActiveRecord;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UCenterController extends Controller
{
    /**
     * Index Page
     */
    public function index()
    {
        $user = Auth::user();
        $records = UserActiveRecord::where('user_id', $user->id)->latest()->paginate(10);

        return view('user.ucenter.index', compact('user', 'records'));
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
            'bio'           =>  'nullable|string|max:100',
        ]);

        $user->nickname = $request->nickname;
        $user->gender = $request->gender;
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
        return view('user.ucenter.realname-verify', compact('user'));
    }

    /**
     * Index Page
     */
    public function settingNotice()
    {
        $user = Auth::user();
        return view('user.ucenter.setting-notice', compact('user'));
    }

    /**
     * Index Page
     */
    public function SecurityCenter()
    {
        $user = Auth::user();
        return view('user.ucenter.security-center', compact('user'));
    }

    /**
     * Avatar Edit
     */
    public function avatarEdit()
    {
        $user = Auth::user();
        return view('user.ucenter.avatar-edit', compact('user'));
    }

    /**
     * Avatar Update
     */
    public function avatarUpdate(Request $request)
    {
        $this->validate($request, [
            'image'     =>  'required|image',
        ]);

        $user = Auth::user();

        $filePath = 'uploads/users/avatars';
        $fileName = Storage::putFile($filePath, $request->image);

        $user->update([
            'avatar'    =>  $fileName
        ]);
        $user->save();

        return response()->json([
            'status'    =>  200,
            'data'      =>  [
                'avatar'    =>  $user->avatar,
            ],
        ]);
    }

    /**
     * Profile BgImg Update
     */
    public function profileBgImgUpdate(Request $request)
    {
        $this->validate($request, [
            'image'     =>  'required|image',
        ]);

        $user = Auth::user();

        $filePath = 'uploads/users/profile_bg_imgs';
        $fileName = Storage::putFile($filePath, $request->image);

        $user->update([
            'profile_bg_img'    =>  $fileName
        ]);
        $user->save();

        return response()->json([
            'status'    =>  200,
            'data'      =>  [
                'profile_bg_img'    =>  $user->profile_bg_img,
            ],
        ]);
    }
}
