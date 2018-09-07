@extends('poyang-lake-cycling.layout')

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
                        缴纳报名费和押金 <small>(2/3)</small>
                    </h1>
                    <p class="text-center">
                        使用微信支付报名费 50 元，
                        缴费后可能稍有延迟，请稍等片刻后<a href="{{ route('poyang-lake-cycling.payment') }}">刷新页面</a>，如 10 分钟后<a href="{{ route('poyang-lake-cycling.payment') }}">刷新页面</a>仍未显示已支付请联系我们。
                    </p>
                </div>

                <div class="col-sm-4 offset-sm-2">
                    <div class="card mt-4">
                        <div class="card-header">
                            报名费
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">报名费 50 元</h5>
                            <p class="card-text">
                                报名费含：竞赛保险、竞赛号码牌、竞赛号码布、纪念品。
                            </p>

                            @if ($applyData && $applyData->is_payment_apply_fee)
                                <button class="btn btn-default" disabled="disabled">
                                    已支付
                                </button>
                            @else
                                <button onclick="postSubmit('{{ route('poyang-lake-cycling.pay-apply-fee') }}')" class="btn btn-primary">
                                    <i class="fa fa-weixin"></i> 使用微信支付报名费
                                </button>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="card mt-4">
                        <div class="card-header">
                            计时芯片押金
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">计时芯片押金 100 元</h5>
                            <p class="card-text">
                                所有参赛选手在报到领取号码布、号码牌时，需领取计时芯片，并缴纳芯片押金100元，赛后凭芯片退还押金
                            </p>
                        </div>
                    </div>
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
@stop
