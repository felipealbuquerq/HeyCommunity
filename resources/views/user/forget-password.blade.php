@extends('layouts.default')

@section('title')
找回密码 - {{ $system->site_title }}
@endsection

@section('mainBody')
<div id="section-mainbody" class="page-user-signup">
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3 m-np">
                <div class="card" style="margin-top:100px;">
                    <div class="card-body p-5">
                        <form action="{{ route('user.forget-password-handler') }}" method="post" class="">
                            {{ csrf_field() }}

                            <h2 class="text-center pt-2">找回密码</h2>
                            <br>

                            <div class="form-group">
                                <div class="input-group">
                                    <input required class="form-control" type="number" id="input-phone" name="phone" value="{{ old('phone') }}" placeholder="帐号绑定的手机号码">
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
                                <input required class="form-control" type="password" name="password" placeholder="新密码, 字母和数字的组合, 至少 6 个字符">
                                <div class="text-danger">{{ $errors->first('password') }}</div>
                            </div>

                            <div class="form-group mb-3">
                                <input required class="form-control" type="password" name="password_confirmation" placeholder="重复输入新密码">
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-block btn-primary">提交</button>
                            </div>

                            <footer class="mt-3">
                                <div class="">
                                    <a class="" href="{{ route('user.default-login') }}">尝试登录</a>
                                </div>
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

      if (phone.length != 11) {
        alert('手机号码不正确');
        return false;
      }

      btnEl.attr('disabled', 'true');

      $.ajax("{{ route('user.get-forget-password-captcha') }}", {
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
