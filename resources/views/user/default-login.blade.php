@extends('layouts.default')

@section('title')
登录 - {{ $system->site_title }}
@endsection

@section('mainBody')
<div id="section-mainbody" class="page-user-login">
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3 m-np">
                <div class="card" style="margin-top:100px;">
                    <div class="card-body p-5">
                        <form action="{{ route('user.default-login-handler') }}" method="post">
                            {{ csrf_field() }}

                            <h2 class="text-center pt-2">欢迎登录</h2>
                            <br>

                            <div class="form-group">
                                <input required class="form-control" type="number" name="phone" value="{{ old('phone') }}" placeholder="手机号码">
                                <div class="text-danger">{{ $errors->first('phone') }}</div>
                            </div>

                            <div class="form-group mb-3">
                                <input required class="form-control" type="password" name="password" placeholder="密码">
                                <div class="text-danger">{{ $errors->first('password') }}</div>
                            </div>

                            <div class="text-center">
                                <button class="btn btn-block btn-primary">登录</button>
                            </div>

                            <footer class="mt-3">
                                <div class="pull-right">
                                    <a class="text-muted">忘记密码？</a>
                                </div>
                                <div>
                                    <div>
                                        没有帐号? 现在<a class="" href="{{ route('user.default-signup') }}">注册</a>
                                    </div>
                                    @if (Agent::isDesktop())
                                        <div>
                                            <a href="{{ route('user.login-wechat') }}"><i class="fa fa-wechat"></i> 使用微信快速登录</a>
                                        </div>
                                    @endif
                                </div>
                            </footer>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
