@extends('layouts.default')

@section('title')
注册 - {{ $system->site_title }}
@endsection

@php
$wxShareDisable = true;
@endphp

@section('mainBody')
<div id="section-mainbody" class="page-user-signup">
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3 m-np">
                    <div class="card" style="margin-top:100px;">
                        <div class="card-body p-5">
                            <form action="{{ route('user.default-signup-handler') }}" method="post" class="">
                                {{ csrf_field() }}

                                <h2 class="text-center pt-2">用户注册</h2>
                                <br>

                                <div class="form-group">
                                    <input class="form-control" type="text" name="nickname" value="{{ old('nickname') }}"
                                           placeholder="昵称">
                                    <div class="text-danger">{{ $errors->first('nickname') }}</div>
                                </div>

                                <div class="form-group">
                                    <input class="form-control" type="text" name="phone" value="{{ old('phone') }}"
                                           placeholder="手机号码">
                                    <div class="text-danger">{{ $errors->first('phone') }}</div>
                                </div>

                                <div class="form-group mb-3">
                                    <input class="form-control" type="password" name="password" placeholder="密码">
                                    <div class="text-danger">{{ $errors->first('password') }}</div>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-block btn-primary">注册</button>
                                </div>

                                <footer class="mt-3">
                                    <div class="pull-right">
                                        已有帐号? 现在<a class="" href="{{ route('user.default-login') }}">登录</a>
                                    </div>

                                    @if (Agent::isDesktop())
                                        <a href="{{ route('user.login-wechat') }}"><i class="fa fa-wechat"></i> 使用微信快速登录</a>
                                    @endif
                                </footer>
                            </form>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>
@endsection
