<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Agent;
use App\User;
use App\Topic;
use App\Activity;
use App\TopicComment;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     *  Login
     */
    public function login()
    {
        // if in wechat browser
        if (strpos(Agent::getUserAgent(), 'MicroMessenger') !== false) {
            return redirect()->route('user.login-by-wechat');
        } else {
            if (Agent::isDesktop()) {
                return redirect()->route('user.login-wechat');
            } else {
                return redirect()->route('user.default-login');
            }
        }
    }

    /**
     *  Signup
     */
    public function signup()
    {
        // if in wechat browser
        if (strpos(Agent::getUserAgent(), 'MicroMessenger') !== false) {
            return redirect()->route('user.login-by-wechat');
        } else {
            if (Agent::isDesktop()) {
                return redirect()->route('user.default-signup');
            } else {
                return redirect()->route('user.default-signup');
            }
        }
    }

    /**
     * Logout
     */
    public function logout()
    {
        Auth::logout();

        flash('登出成功');
        return back();
    }

    /**
     * Login page with wechat
     */
    public function loginWechat()
    {
        // login by wechat browser
        if (strpos(Agent::getUserAgent(), 'MicroMessenger') !== false) {
            return redirect()->route('user.login-by-wechat');
        }

        $token = str_random(10);
        return view('user.login-wechat', compact('token'));
    }

    /**
     * Login page with wechat
     */
    public function loginByWechat(Request $request)
    {
        // login by wechat app
        if (
            !$request->has('token') &&
            session('after-login-redirect-route') &&
            (strpos(Agent::getUserAgent(), 'MicroMessenger') !== false)
        ) {
            $route = session()->pull('after-login-redirect-route') ?: 'home';
            return redirect()->route($route);
        }

        //
        // @todo mark this user can be login

        event(new \App\Events\UserLoggedByWechatTransferBroadcast($request->token));

        return view('user.login-by-wechat');
    }

    /**
     * Login transfer handler
     */
    public function loginByWechatHandler(Request $request)
    {
        $this->validate($request, [
            'user_id'       =>      'required|integer',
        ]);

        // @todo validate this user can be login

        Auth::loginUsingId($request->user_id);

        flash('登录成功')->success();
        $route = session()->pull('after-login-redirect-route') ?: 'home';
        return redirect()->route($route);
    }

    /**
     * Login page with wechat
     */
    public function loginByWechatSuccess()
    {
        return view('user.login-by-wechat-success');
    }

    /**
     * Default login page
     */
    public function defaultLogin()
    {
        return view('user.default-login');
    }

    /**
     * Default login handler
     */
    public function defaultLoginHandler(Request $request)
    {
        $this->validate($request, [
            'phone'     =>      'required|integer',
            'password'  =>      'required|string',
        ]);

        if (Auth::attempt(['phone' => $request->phone, 'password' => $request->password])) {
            $route = session()->pull('after-login-redirect-route') ?: 'home';
            return redirect()->route($route);
        } else {
            return back()->withInput()->withErrors(['fail' => '手机号码或密码不正确']);
        }
    }

    /**
     * Default sign up page
     */
    public function defaultSignup()
    {
        return view('user.default-signup');
    }

    /**
     * Sign up handler
     */
    public function defaultSignupHandler(Request $request)
    {
        $this->validate($request, [
            'nickname'  =>  'required|string',
            'phone'     =>  'required|string|unique:users',
            'password'  =>  'required',
        ]);

        $user = new User;
        $user->nickname     =   $request->nickname;
        $user->phone        =   $request->phone;
        $user->password     =   Hash::make($request->password);
        $user->avatar       =   '/images/user/avatars/default/' . random_int(1, 15) . '.png';

        if ($user->save()) {
            Auth::login($user);

            $route = session()->pull('after-login-redirect-route') ?: 'home';
            return redirect()->route($route);
        } else {
            return back();
        }
    }

    /**
     * User profile update
     */
    public function profileUpdate(Request $request)
    {
        $user = Auth::user();

        $this->validate($request, [
            'nickname'      =>  'required|string',
            'gender'        =>  'required|integer',
            'phone'         =>  'nullable|string|unique:users,phone,' . $user->id,
            'email'         =>  'nullable|string|unique:users,email,' . $user->id,
            'bio'           =>  'nullable|string',
        ]);

        $user->nickname = $request->nickname;
        $user->gender = $request->gender;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->bio = $request->bio;

        if ($user->save()) {
            flash('更新成功')->success();
            return back();
        } else {
            flash('更新失败')->error()->important();
            return back()->withInput();
        }
    }

    /**
     * Toggle sock puppet
     */
    public function toggleSockPuppet($id)
    {
        if (
            env('SOCK_PUPPET_ENABLE') &&
            isset($_COOKIE['sockPuppetHash']) && $_COOKIE['sockPuppetHash'] == env('SOCK_PUPPET_HASH')
        ) {
            Auth::loginUsingId($id);

            flash('操作成功')->success();
            return back();
        }

        flash('您无权执行此操作')->error()->important();
        return back();
    }
}
