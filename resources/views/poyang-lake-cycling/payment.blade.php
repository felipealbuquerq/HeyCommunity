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
                        缴费 <small>(2/4)</small>
                    </h1>
                    <br>
                    <br>
                </div>

                <div class="col-sm-4 offset-sm-2">
                    <div class="card">
                        <div class="card-header">
                            报名费
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">报名费 50 元</h5>
                            <p class="card-text">
                                报名费含：竞赛保险、竞赛号码牌、竞赛号码布、纪念品；
                            </p>
                            <a href="#" class="btn btn-primary"><i class="fa fa-weixin"></i> 使用微信进行支付</a>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-header">
                            计时芯片押金
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">计时芯片押金 100 元</h5>
                            <p class="card-text">
                                计时芯片押金将在赛后自动原路退回到您的微信钱包或银行卡中。
                            </p>
                            <a href="#" class="btn btn-primary"><i class="fa fa-weixin"></i> 使用微信进行支付</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop


@section('wechat_payment')
<script src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js" type="text/javascript" charset="utf-8"></script>
<script>
    $(document).ready(function() {
      wx.ready(function() {
        wx.chooseWXPay({
          timestamp: "{{ $config['timestamp'] }}",
          nonceStr: "{{ $config['nonceStr'] }}",
          package: "{{ $config['package'] }}",
          signType: "{{ $config['signType'] }}",
          paySign: "{{ $config['paySign'] }}",
          success: function (res) {
            // 支付成功后的回调函数
          }
        });
      });
    });
</script>
@stop
