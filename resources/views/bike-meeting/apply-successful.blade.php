@extends('bike-meeting.layout')

@section('title')
    报名
@endsection

@section('description')
@endsection

@section('mainBody')
    <div id="section-mainbody" class="page-news-index">
        <div class="container" style="margin-top:40px;">
            <div class="row">
                <div class="col-sm-12">
                    <h1 class="h4 text-center">
                        @if ($applyData && $applyData->is_payment)
                            报名成功
                        @elseif ($applyData && !$applyData->is_payment)
                            缴费后完成报名
                        @endif
                    </h1>

                    <p class="mt-2 text-center">
                        您好 <b>{{ $applyData->nickname }}</b>，
                        @if ($applyData && $applyData->is_payment)
                            您已成功报名并完成缴费
                        @elseif ($applyData && !$applyData->is_payment)
                            缴费后完成报名，<a href="{{ route('bike-meeting.payment') }}">立即缴费</a>
                        @endif
                    </p>

                    <p class="mt-4 text-center">
                        <b>活动时间</b>：2019年1月12日(星期六)，下午3点至晚上8点 <br>
                        <b>活动地点</b>：梅水观音坐莲农庄 （暂定） <br>
                        <b>活动流程</b>：3点至5点在农庄自由活动自由娱乐，5点半开始吃饭，席间席后才艺表演，抽奖活动。 <br>
                    </p>
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
                window.location.assign('{{ route("bike-meeting.apply-successful") }}');
              },
              fail: function (res) {
                alert('支付失败: ' + res);
                window.location.assign('{{ route("bike-meeting.payment") }}');
              }
            });
          });
        </script>
    @endif
@endsection
