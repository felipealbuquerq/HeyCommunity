@extends('bike-meeting.layout')

@section('title')
    报名
@endsection

@section('description')
@endsection

@section('mainBody')
    <div id="section-mainbody" class="page-news-index">
        <div class="container pt-4">
            <div class="row">
                <div class="col-sm-12">
                    <h1 class="h4 mt-4 text-center">
                        年会报名及缴费
                    </h1>

                    <form class="mt-4" action="{{ route('bike-meeting.payment') }}" method="post">
                        {{ csrf_field() }}

                        <div class="form-group row">
                            <label for="input-nickname" class="col-sm-2 col-form-label">姓名与昵称</label>

                            <div class="col-sm-10">
                                <input required name="nickname" type="text" class="form-control" id="input-nickname" value="{{ old('nickname') }}">

                                <div class="text-danger">{{ $errors->first('nickname') }}</div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="input-phone" class="col-sm-2 col-form-label">手机号</label>

                            <div class="col-sm-10">
                                <input required name="phone" type="text" class="form-control" id="input-phone" value="{{ old('phone') }}">

                                <div class="text-danger">{{ $errors->first('phone') }}</div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="offset-sm-2 col-sm-10">
                                <button class="btn btn-primary btn-block">确认报名并缴费</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('wechat_payment')
    @if (isset($wechatJs) && isset($wechatPayConfig))
        <script src="https://res.wx.qq.com/open/js/jweixin-1.2.0.js" type="text/javascript" charset="utf-8"></script>
        <script>
          wx.config({!! $wechatJs->config([]) !!});
          wx.ready(function() {

            wx.chooseWXPay({
              timestamp: "{{ $wechatPayConfig['timestamp'] }}",
              nonceStr: "{{ $wechatPayConfig['nonceStr'] }}",
              package: "{{ $wechatPayConfig['package'] }}",
              signType: "{{ $wechatPayConfig['signType'] }}",
              paySign: "{{ $wechatPayConfig['paySign'] }}",
              success: function (res) {
                window.location.assign('{{ route("poyang-lake-cycling.payment") }}');
              },
              fail: function (res) {
                alert('支付失败: ' + res);
                window.location.assign('{{ route("poyang-lake-cycling.payment") }}');
              }
            });
          });
        </script>
    @endif
@endsection
