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
                                <input required class="form-control" type="text" name="nickname" value="{{ old('nickname') }}" placeholder="昵称, 至少 3 个字符">
                                <div class="text-danger">{{ $errors->first('nickname') }}</div>
                            </div>

                            <div class="form-group">
                                <div class="input-group">
                                    <input required class="form-control" type="number" id="input-phone" name="phone" value="{{ old('phone') }}" placeholder="手机号码">
                                    <div class="input-group-append">
                                        <button class="btn btn-secondary" id="get-captcha-btn" type="button" onclick="getCaptcha(event, $('#input-phone').val())">获取短信验证码</button>
                                    </div>
                                </div>
                                <div class="text-danger">{{ $errors->first('phone') }}</div>
                            </div>

                            <div class="form-group">
                                <input required class="form-control" type="number" name="captcha" value="{{ old('captcha') }}" placeholder="短信验证码">
                                <div class="text-danger">{{ $errors->first('captcha') }}</div>
                            </div>

                            <div class="form-group mb-3">
                                <input required class="form-control" type="password" name="password" placeholder="密码, 字母和数字的组合, 至少 6 个字符">
                                <div class="text-danger">{{ $errors->first('password') }}</div>
                            </div>

                            <div class="form-group mb-3">
                                <input required class="form-control" type="password" name="password_confirmation" placeholder="重复输入密码">
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

<script>
    function getCaptcha(event, phone) {
      var btnEl = $(event.target);
      var btnElDefaultText = btnEl.html();
      var secoundNum = 60;
      var timer;

      btnEl.attr('disabled', 'true');

      if (phone.length != 11) {
        alert('手机号码不正确');
        return false;
      }

      $.ajax("{{ route('user.get-signup-phone-captcha') }}", {
        method: 'POST',
        data: {phone: phone},
        success: function() {
          btnEl.html(secoundNum + 's');

          timer = setInterval(function() {
            secoundNum -= 1;

            if (secoundNum <= 0) {
              secoundNum = 60;
              clearInterval(timer);
              timer = null;

              btnEl.attr('disabled', false);
              btnEl.html(btnElDefaultText);
            } else {
              btnEl.html(secoundNum + 's');
            }
          }, 1000);

          alert('获取短信验证码成功');
        },
        error: function(xhr) {
          alert('获取短信验证码失败: ' + xhr.responseJSON.message);
          btnEl.attr('disabled', false);
          btnEl.html(btnElDefaultText);
        }
      });
    }
</script>
@endsection
