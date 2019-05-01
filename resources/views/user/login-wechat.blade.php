@extends('layouts.default')

@section('title')
微信登录 - {{ $system->site_title }}
@endsection

@section('mainBody')
<div id="section-mainbody" class="page-user-login-wechat">
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3 m-np">
                <div class="card" style="margin-top:100px;">
                    <div class="card-body p-5">
                        <h2 class="text-center">微信扫码登录</h2>
                        <div class="card-text text-center">
                            打开手机微信，扫描下方二维码进行登录
                        </div>

                        <div class="text-center">
                            <img class="rounded img-fluid"
                                 style="width:300px;"
                                 src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(600)->generate(route('user.login-by-wechat', ['token' => $token]))) !!} ">
                        </div>

                        <hr class="">
                        <div class="card-text">
                            <div class="pull-right">
                                <a href="{{ route('user.default-login') }}">帐号密码登录</a>
                            </div>
                            <a href="{{ route('user.default-signup') }}">注册新帐号</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    Echo.channel('logged-by-wechat-transfer-t-{{ $token }}')
        .listen('.transfer', function(e) {
            var url = '{{ route('user.login-by-wechat-handler') }}';
            var params = {
                user_id: e.user.id,
            };
            postSubmit(url, params);
        });
</script>
@endsection
